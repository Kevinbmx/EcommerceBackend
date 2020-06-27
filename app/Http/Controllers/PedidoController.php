<?php

namespace App\Http\Controllers;

use App\Model\Pedido;
use App\Model\Carrito;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PedidoController extends Controller
{
    public function pedidoByUserId(Request $request){
        // return $user_id;
        $user = auth('api')->user();
        // return $user;
        if(!is_null($user)){
            $pedido = Pedido::where('estado','=','carrito')
                ->where('user_id',$user->id)
                ->first();
        }else{
            $pedido = null;
        }
        
        return response()
        ->json([
            'message'=>'selected',
            'pedido'=> $pedido
        ]);
    }

    public function pedidoById($id){
        $pedido = Pedido::where('estado','=','carrito')
                ->where('id',$id)
                ->first();
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

    public function store(Request $request)
    {
        try{
            if(!is_null(auth('api')->user())){
                $user_id = $request->user('api')->id;
            }else{
                $user_id = null;
            }
            $pedido = Pedido::create(['user_id' => $user_id,'estado'=> 'carrito']);
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
        // $user_id = auth()->id();
        $user_id = $request->user('api')->id;
        try {
            $pedido = Pedido::where('id',$id)->update([
                    'estado' => $request->estado,
                    'direction_id' => $request->direction_id,
                    'fecha_entrega' => $request->fecha_entrega,
                    'fecha_anulacion' => $request->fecha_anulacion,
                    'motivo_anulacion' => $request->motivo_anulacion,
                    'total' => $request->total,
                    'user_id' => $user_id
                    ]);
                    return response()
                ->json([
                    'updated' => true,
                    'pedido'=> $pedido,
                    'type'=> 'update'
                ]);
        } catch (\Throwable $th) {
            return response()
                ->json([
                    'updated' => false,
                    'pedido'=> [],
                    'type'=> 'update'
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

    public function destroy($id){
        try {
            $carrito = Carrito::where('pedido_id',$id)->delete();
            $pedido = Pedido::where('id',$id)->delete();
            return response()
            ->json([
                'delete' => true,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }


}
