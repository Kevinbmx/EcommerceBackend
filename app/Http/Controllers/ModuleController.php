<?php

namespace App\Http\Controllers;

use App\model\module;
use Illuminate\Http\Request;
use Acceso;
class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hasPermission = false;
        $module='';
        if(Acceso::hasPermission(Acceso::getListarModulo())){
            $module = Module::paginate(10);
            $hasPermission = true;
        }
         return response()
         ->json([
             'hasPermission' => $hasPermission,
             'module'=> $module,
         ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hasPermission = false;
        $module='';
        if(Acceso::hasPermission(Acceso::getCrearModulo())){
            $this->validate($request, [
                'name' => 'required',
            ]); 

            $module = new Module;
            $module->name = $request->name;
            $module->save();
            $hasPermission = true;
        }
        // $create = Post::create($request->all());
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'module'=> $module,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\module  $module
     * @return \Illuminate\Http\Response
     */
    public function moduleById($id)
    {
        $hasPermission = false;
        $module='';
        if(Acceso::hasPermission(Acceso::getActualizarModulo())){
            $module = Module::find($id);
            $hasPermission = true;
        } 
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'module'=> $module,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hasPermission = false;
        $module='';
        if(Acceso::hasPermission(Acceso::getActualizarModulo())){
            $this->validate($request, [
                'name' => 'required',
            ]);

            $module = Module::findOrFail($id);
            $module->update([
                'name' => $request->name,
            ]);
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'module'=> $module,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\module  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hasPermission = false;
        $module='';
        if(Acceso::hasPermission(Acceso::getEliminarModulo())){
            $module = Module::findOrfail($id);
            $module->delete();
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'module'=> $module,
        ]);
    }
}
