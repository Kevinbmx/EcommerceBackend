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

    public function tusPedidoConfirmadosByUserId(){
        $user_id = auth()->id();
        $pedido = Pedido::with('direction')->with('carrito.product.file')->where('user_id',$user_id)->whereNotIn('estado', ['carrito'])->paginate(2);
        
        // dd(empty($pedido));
        // return  $pedido;
        return response()->json($pedido);
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

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'estado' => 'required',   
            'fecha_entrega' => 'required',
            'total' => 'required',
            'direction_id' => 'required',
        ]);
        $user_id = auth()->id();
        $pedido = Pedido::where('user_id',$user_id)
                    ->where('id',$id);
        if(count($pedido->get()) > 0){
            $pedido->update([
                'estado' => $request->estado,
                'fecha_entrega' => $request->fecha_entrega,
                'fecha_anulacion' => $request->fecha_anulacion,
                'motivo_anulacion' => $request->motivo_anulacion,
                'total' => $request->total,
                'direction_id' => $request->direction_id,
            ]);
            return response()
            ->json([
                'updated' => true,
                'pedido'=> $pedido->first(),
                'type'=> 'update'
            ]);
        }else{
            return response()
            ->json([
                'updated' => false,
            ]);
        }
    }

    public function motivoAnularPedido(Request $request)
    {
        $this->validate($request, [
            'pedido_id' => 'required',
            'motivo_anulacion' => 'required',   
            'fecha_anulacion' => 'required'
        ]);
        $user_id = auth()->id();
        $pedido = Pedido::where('user_id',$user_id)
                    ->where('id',$request->pedido_id)->update(['motivo_anulacion' => $request->motivo_anulacion,'fecha_anulacion' => $request->fecha_anulacion,'estado' => 'anulado']);
        return response()
        ->json([
            'updated' => true,
            'pedido'=> $pedido,
            'type'=> 'anulado'
        ]);
    }


}
