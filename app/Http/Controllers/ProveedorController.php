<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedor = Proveedor::find(1);
        return  (array) $proveedor;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
            // 'nit' => ' required'
            ]);
        // return $request;

        $proveedor = Proveedor::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'nit' => $request->nit,
        ]);
        return response()
        ->json([
            'message'=>'creted',
            'proveedor'=> $proveedor
        ]);
        // return $proveedor;
    }
    //no se ha terminado aun
    public function createPhones(Request $request){
        // return $request->all();

        $validator = Validator::make($request->all(), [
            'proveedor.descripcion' => 'required',
        ]);
        if ($validator->fails()) {
            // return $validator;
        }
        // return $validator;
        return $validator->fails();
        // $this->validate($request, [
        //     'nombre' => 'required',
        //     'descripcion' => 'required',
        //     'numero_telefonico' => ' required',
        //     'proveedor' => ' required|json',
        //     // 'proveedor["nombre"]' => 'required',
        //     // 'proveedor.descripcion' => 'required',
        //     ]);
        $proveedor = $request->proveedor;
        $proveedor->phones()->create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'numero_telefonico' => $request->numero_telefonico,
        ]);
        return $proveedor;
    }

    public function createDirecciones(Request $request){
        $this->validate($request, [
            'direccion' => 'required',
            'latitud' => 'required',
            'longitud' => ' required',
            'proveedor' => ' required'
        ]);
        $proveedor = $request->proveedor;
        $proveedor->direcciones()->create([
            'direccion' => $request->nombre,
            'latitud' => $request->descripcion,
            'longitud' => $request->numero_telefonico,
        ]);
        return $proveedor;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        //
    }
}
