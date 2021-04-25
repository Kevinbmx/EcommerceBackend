<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Helper\Acceso;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hasPermission = false;
        $role='';
        if(Acceso::hasPermission(Acceso::getlistarRol())){
            $role = Role::paginate(10);
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'role'=> $role,
        ]);
    }

    public function roleById($id)
    {
        $hasPermission = false;
        $role='';
        if(Acceso::hasPermission(Acceso::getActualizarRol())){
            $role = Role::findOrFail($id);
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'role'=> $role,

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
        $role='';
        if(Acceso::hasPermission(Acceso::getCrearRol())){
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',

            ]);

            $role = new Role;
            $role->name = $request->name;
            $role->description = $request->description;
            $role->save();
            $hasPermission = true;
        }
        // $create = Post::create($request->all());
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'role'=> $role,

        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $hasPermission = false;
        $role='';
        if(Acceso::hasPermission(Acceso::getActualizarRol())){
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
            ]);

            $role = Role::where('id', $id)
                ->update(['name' => $request->name,
                'description'=>$request->description]);
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'role'=> $role,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hasPermission = false;
        $role='';
        if(Acceso::hasPermission(Acceso::getEliminarRol())){
            $role = Role::findOrfail($id);
            $role->delete();
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'role'=> $role,
        ]);
    }

}
