<?php

namespace App\Http\Controllers;

use App\model\Permission;
use App\model\Module;
use Illuminate\Http\Request;
use Acceso;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hasPermission = false;
        $moduleWithPermission='';
        if(Acceso::hasPermission(Acceso::getListarCantidadPermisoPorModulo())){
            $moduleWithPermission = Module::with('permission')->paginate(10);
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'moduleWithPermission'=> $moduleWithPermission,
            
        ]);
    }
    public function permissionById($id)
    {
        $hasPermission = false;
        $permission='';
        if(Acceso::hasPermission(Acceso::getActualizarPermiso())){
            $permission =  Permission::findOrFail($id);
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'permission'=> $permission,
            
        ]);
    }
    //esta funcion es para llamar como una api en el front end para saber si tiene o no tiene permiso
    public function hasThisPermission(Request $request)
    {
        $this->validate($request, [
            'namePermission' => 'required',
        ]); 
        $hasPermission = Acceso::hasPermission($request->namePermission);
        return response()
        ->json([
            'hasPermission' =>  $hasPermission 
        ]);
    }
    

    public function ver($idModule)
    {
        $hasPermission = false;
        $permission='';
        if(Acceso::hasPermission(Acceso::getListarPermiso())){
            $permission = Module::with('permission')->where('id',$idModule)->first();
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'permission'=> $permission,
            
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
        $permission='';
        if(Acceso::hasPermission(Acceso::getCrearPermiso())){
            $this->validate($request, [
                'name' => 'required',
                'module_id' => 'required',
                
            ]); 

            $permission = new Permission;
            $permission->name = $request->name;
            $permission->module_id = $request->module_id;
            $permission->save();
            $hasPermission = true;
            // $create = Post::create($request->all());
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'permission'=> $permission,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hasPermission = false;
        $permission='';
        $save = false;
        if(Acceso::hasPermission(Acceso::getActualizarPermiso())){
            $this->validate($request, [
            'name' => 'required',
            'module_id' => 'required',
            ]);
            try{
                $permission = Permission::findOrFail($id);
                $permission->update([
                    'name' => $request->name,
                    'module_id' =>$request->module_id
                    ]);
                    $hasPermission = true;
                    $save = true;
               
            }   catch (\Illuminate\Database\QueryException $e) {
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    return response()
                    ->json([
                        'message'=>'duplicate',
                        'save'=>$save 
                    ]);
                }
            }
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'permission'=> $permission,
            'save'=>$save 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hasPermission = false;
        $permission='';
        if(Acceso::hasPermission(Acceso::getEliminarPermiso())){
            $permission = Permission::findOrfail($id);
            $permission->delete();
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'permission'=> $permission,
        ]);
    }
}
