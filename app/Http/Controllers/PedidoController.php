<?php

namespace App\Http\Controllers;

use App\Model\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function pedidoByUserId(){
        $user_id = auth()->id();
        $pedido = Pedido::where('user_id',$user_id)->where('estado','carrito')->first();
        // dd(empty($pedido));
        return response()
        ->json([
            'message'=>'selected',
            'pedido'=> $pedido
        ]);
    }

    public function store()
    {
        try{
            $user_id = auth()->id();
            $pedido = Pedido::firstOrCreate(['user_id' => $user_id,'estado'=> 'carrito']);
            return response()
            ->json([
                'message'=>'create',
                'pedido'=> $pedido
            ]);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            // return $errorCode;
            if($errorCode == 1062){
                return response()
                ->json(['message'=>'duplicate',
                        'pedido'=> []]);
            }
        }
    }

    public function update(Request $request, $idProduct)
    {
        $this->validate($request, [
            'estado' => 'required',   
            'fecha_entrega' => 'required',
            'fecha_anulacion' => 'required',
            'total' => 'required',
            'direction_id' => 'required',
        ]);
        $product = Product::findOrFail($idProduct);
        // return $request;
        $product->update([
            'name' => $request->name,
            'modelo' => $request->modelo,
            'quantity' => $request->quantity,
            'brand' => $request->brand,
            'price' => $request->price,
            'category_id' =>$request->category_id,
            'peso' => $request->peso,
            'alto' => $request->alto,
            'ancho'=> $request->ancho,
            'fondo'=> $request->fondo,
            'parent_id'=> $request->parent_id,
            'statusProduct_id'=>$request->statusProduct_id,
            'description'=>$request->description
        ]);
        return response()
        ->json([
            'saved' => true,
            'product_id'=> $idProduct,
            'type'=> 'update'
        ]);
    }


}
