<?php

namespace App\Http\Controllers;

use App\Model\Carrito;
use App\Model\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CarritoController extends Controller
{
    public function carritoByPedidoId($pedido_id){
        // dd($pedido_id);
        $user_id = auth()->id();
        $carrito = Carrito::with('product.file')
                ->join('pedido','pedido.id', 'pedido_id')
                ->where('pedido_id', $pedido_id)
                ->where('pedido.user_id',$user_id)
        ->get();
       $wischlist = $this->changeCartProductForWishList($carrito);
        // $carrito->files()->get();
        // dd(empty($carrito));
            
        return  response()->json([
            'message' => 'create',
            'carrito'=> $carrito,
            'wishlist'=>$wischlist
            ]);
    }
    public function changeCartProductForWishList($carrito){
        $user_id = auth()->id();
        $wischlist = '';
        foreach ($carrito as $cart) {
            if( $cart['product']['quantity'] < $cart['quantity']){
                try{
                    Wishlist::Create(['user_id' => $user_id, 'product_id'=>$cart['product']['id']]);
                    $wischlist = 'se ha añadido un producto a lista de deceo';
                }
                catch (QueryException $e) {
                    // $errorCode = $e->errorInfo[1];
                    // // return $errorCode;
                    // if($errorCode == 1062){
                    //    echo ("duplicado");
                    // }
                }
               $this->destroy($cart['product']['id'], $cart['pedido_id']);
            }
        }
        // $wischlist = Wishlist::where('user_id',$user_id)->get();
        return  $wischlist;
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
            return response()->json([
                'message' => 'create',
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
        $user_id = auth()->id();
        $carrito = Carrito::join('pedido','pedido.id', 'pedido_id')
                ->where('pedido_id', $pedido_id)
                ->where('pedido.user_id',$user_id)
                ->where('carrito.product_id',$product_id)
        ->delete();
        // dd($carrito);
        if($carrito == 0){
            $message = false;
        }
        return response()
            ->json([
                'deleted' => $message
            ]);
    }
}
