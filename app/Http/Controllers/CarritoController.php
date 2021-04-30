<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CarritoController extends Controller
{
    public function carritoByPedidoId($pedido_id){
        // dd($pedido_id);
        // $user = auth('api')->user();
        // return $user;
        $carrito = Carrito::with('product')
            ->join('pedido','pedido.id', 'pedido_id')
            ->where('pedido_id', $pedido_id)
            ->get();

        $wischlist = $this->changeCartProductForWishList($carrito);

        $carrito = Carrito::with('product.file')
            ->join('pedido','pedido.id', 'pedido_id')
            ->where('pedido_id', $pedido_id)
            ->get();

        return  response()->json([
            'message' => 'selected',
            'carrito'=> $carrito,
            'wishlist'=> $wischlist
            ]);
    }
    public function changeCartProductForWishList($carrito){
        // if($user_id = auth('api')->user()->id)
        // $user_id = auth('api')->user()->id;
        $wischlist = null;
        $user = auth('api')->user();
        if($user){
            foreach ($carrito as $cart) {
                if( $cart->product->quantity < $cart->quantity){
                    try{
                        $wischlist = Wishlist::updateOrCreate(['user_id' => $user->id, 'product_id'=>$cart->product->id]);
                        // $wischlist = 'se ha añadido un producto a lista de deceo';
                    }
                    catch (QueryException $e) {
                        return  $wischlist +"error";
                    }
                $this->destroy($cart['product']['id'], $cart['pedido_id']);
                }
            }
        }
        return  $user;
    }
    public function createOrUpdate(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'product_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'pedido_id' => 'required'
        ]);
        try {
            $carrito = Carrito::updateOrCreate(['product_id' => $request->product_id,'pedido_id' => $request->pedido_id] ,
            ['price' => $request->price,'quantity' => $request->quantity]);
            $selectAllCarrito = $this->carritoByPedidoId($carrito->pedido_id);
            // dd($selectAllCarrito->getData()->carrito);
            // return $carrito;
            return response()->json([
                'create' => true,
                'carrito'=> $selectAllCarrito->getData()->carrito]);
        }
        catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            // return $errorCode;
            if($errorCode == 1062){
                return response()
                ->json(['message'=>'duplicate',
                        'carrito'=> []]);
            }
        }
    }

    public function destroy($product_id,$pedido_id)
    {
        $message = true;
        $user = auth('api')->user();
        // return $user;
        $carrito = Carrito::join('pedido','pedido.id', 'pedido_id')
                ->where('pedido_id', $pedido_id)
                ->when(!is_null($user),function ($query) use ($user){
                    return $query->where('pedido.user_id',$user->id);
                })
                ->where('carrito.product_id',$product_id)
                ->delete();
        if($carrito == 0){
            $message = false;
        }
        // return $carrito;
        return response()
            ->json([
                'deleted' => $message
            ]);
    }

}
