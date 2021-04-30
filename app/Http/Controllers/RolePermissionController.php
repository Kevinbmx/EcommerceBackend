<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Helper\Acceso;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolePermissionController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hasPermission = false;
        $rolePermission='';
        if(Acceso::hasPermission(Acceso::getlistarAcceso())){
            $rolePermission= Role::with('permissions')->paginate(10);
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'rolePermission'=> $rolePermission,

        ]);
    }

    public function getAllModule()
    {
        $hasPermission = false;
        $module='';
        if(Acceso::hasPermission(Acceso::getActualizarAcceso())){
            $module = Module::all();
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'module'=> $module,
        ]);
    }
/**
 * esta funcion me da los permisos con accesos
 */
    public function accesPermissions(Request $request, $idRole)
    {
        $requestModuleId = $request->module_id;

        $hasPermission = false;
        $rolePermission='';
        if(Acceso::hasPermission(Acceso::getActualizarAcceso())){
            $rolePermission = DB::table('role_permissions')
                    ->join('roles','role_permissions.role_id','=','roles.id')
                    ->join('permissions','role_permissions.permission_id','=','permissions.id')
                    ->join('modules','permissions.module_id','=','modules.id')
                    ->where('roles.id',$idRole)
                    ->when(is_array($requestModuleId),function ($query) use ($requestModuleId){
                        return $query->whereIn('modules.id',$requestModuleId);
                    })
                    ->get(['permissions.*']);
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'rolePermission'=> $rolePermission,
        ]);
    }
    //este metodo no requiere tener accesos para usarlo
    public function accesPermissionsByUserToken()
    {
        $user = auth('api')->user();
        $rolePermission = DB::table('role_permissions')
                ->join('roles','role_permissions.role_id','=','roles.id')
                ->join('permissions','role_permissions.permission_id','=','permissions.id')
                ->join('modules','permissions.module_id','=','modules.id')
                ->join('users','roles.id','=','users.role_id')
                ->where('users.id',$user->id)
                ->get(['permissions.*']);
        return response()
        ->json([
            'user' => $user,
            'rolePermission'=> $rolePermission,
        ]);
    }
/**
 * esta funcion me devuelce los permisos que no tienen accesos
 * la variable $requestModuleId tendran que poner ej: "and m.id in (1,2)"
 */
    public function permissionsWithoutAcces(Request $request, $idRole)
    {
        $hasPermission = false;
        $permissionsWithoutAcces='';
        if(Acceso::hasPermission(Acceso::getActualizarAcceso())){
            $requestModuleId = $request->module_id;
            $permissionsWithoutAcces = DB::select(DB::raw("SELECT p.*
            FROM permissions as p
            JOIN modules as m on p.module_id = m.id
            WHERE not EXISTS(select * from  role_permissions as rp
                            JOIN roles as r on r.id = rp.role_id
                                WHERE rp.permission_id = p.id and role_id = $idRole)
                                $requestModuleId
                            "));
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'permissionsWithoutAcces'=> $permissionsWithoutAcces,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$idRole)
    {
        $hasPermission = false;
        $rolePermission='';
        if(Acceso::hasPermission(Acceso::getActualizarAcceso())){
            $this->validate($request, [
                'permission_id' => 'required',
            ]);
            // $permission_id = $request->permission_id;
            // $permission_id = json_decode($request->permission_id,true);
            $rolePermission = Role::find($idRole);
            // $permission = Permission::find($request->permission_id);
            $rolePermission->permissions()->attach($request->permission_id);
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'rolePermission'=> $rolePermission,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     * en la variable $permission_id puedo poner un solo permiso ej: 1
     * tambien puedo poner un array para eliminar en conjunto ej:[1,2]
     * y si no pongo null me borrara todo lo que pertenesca al rol
     */
    public function destroy(Request $request,$idRole)
    {
        $hasPermission = false;
        $rolePermission='';
        if(Acceso::hasPermission(Acceso::getActualizarAcceso())){
            $this->validate($request, [
                'permission_id' => 'required',
            ]);
            // $permission_id = $request->permission_id;
            // $permission_id = json_decode($request->permission_id,true);
            // return $permission_id;
            $rolePermission = Role::find($idRole);
            $rolePermission->permissions()->detach($request->permission_id);
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'rolePermission'=> $rolePermission,
        ]);
    }

}
