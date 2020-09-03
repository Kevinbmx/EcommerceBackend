<?php

namespace App\Http\Controllers;

use App\Model\Pedido;
use App\Model\Carrito;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Acceso;
use Auth;

class PedidoController extends Controller
{
    //-------------solo main page---------------
    public function pedidoByUserId(Request $request){
        $pedido = null;
        $user = auth('api')->user();
        if(!is_null($user)){
            $pedido = Pedido::where('estado','=','carrito')
                ->where('user_id',$user->id)
                ->first();
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

    public function store(Request $request)
    {
        try{
            if(!is_null(auth('api')->user())){
                $user_id = $request->user('api')->id;
            }else{
                $user_id = null;
            }
            $pedido = Pedido::create(['user_id' => $user_id,'estado'=> 'carrito']);
            $pedido = Pedido::where('id',$pedido->id)->first();
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
// finalizacion del main--------------------------------------------------

    //--------------------------------------------------------------
    //----------------------------admin-----------------------------
    // aqui tengo que entrar a vendo/laravel/framework/src/illuminate/database/query/builder.php
    // y modifico la linea $this->wheres[] = compact('type', 'operator', 'query', 'boolean');
    // por esto $this->wheres[] = compact('type',  'query', 'boolean');
    public function pedidoSearch(Request $request){
        $hasPermission = false;
        $pedido='';
        if(Acceso::hasPermission(Acceso::getListarPedido())){
            $pedido = Pedido::when($request->search,function ($query) use ($request){
                $query->whereHas('user', function ($query) use ($request) {
                    $query->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('email','like', '%'.$request->search.'%');
                })->orWhereHas('direction', function ($query) use ($request) {
                    $query->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('direction','like', '%'.$request->search.'%');
                });
            })->orWhere('estado','like', '%'.$request->search.'%')
            ->orWhere('id','=',$request->search)
            ->with('user')->with('direction')->paginate(7);;
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'pedido'=> $pedido
        ]);

        // $hasPermission = false;
        // $pedido='';
        // if(Acceso::hasPermission(Acceso::getListarPedido())){
        //     $pedido = Pedido::with('user')->with('direction')
        //     ->get();
        //     $hasPermission = true;
        // }
        // return response()
        // ->json([
        //     'hasPermission' => $hasPermission,
        //     'pedido'=> $pedido
        // ]);
    }
    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'estado' => 'required',
        //     'fecha_entrega' => 'required',
        //     'total' => 'required',
        //     'direction_id' => 'required',
        // ]);
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


    public function tusPedidoConfirmadosByUserId(){
        $hasPermission = false;
        $pedido='';
        if(Acceso::hasPermission(Acceso::getListarPedidoCliente())){
            $user_id = auth()->id();
            $pedido = Pedido::with('direction')->with('carrito.product.file')->where('user_id',$user_id)->whereNotIn('estado', ['carrito'])->orderBy('updated_at', 'DESC')->paginate(5);
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'pedido'=> $pedido
        ]);
    }

    public function motivoAnularPedido(Request $request)
    {
        $hasPermission = false;
        $pedido='';
        if(Acceso::hasPermission(Acceso::getAnularPedidoCliente())||Acceso::hasPermission(Acceso::getAnularPedidoAdmin())){
            $this->validate($request, [
                'pedido_id' => 'required',
                'motivo_anulacion' => 'required',
                'fecha_anulacion' => 'required'
            ]);
            // return $request;
            $user_id = auth()->id();
            $pedido = Pedido::where('id',$request->pedido_id)->update(['motivo_anulacion' => $request->motivo_anulacion,'fecha_anulacion' => $request->fecha_anulacion,'estado' => 'anulado']);
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'pedido'=> $pedido
        ]);
    }
}
