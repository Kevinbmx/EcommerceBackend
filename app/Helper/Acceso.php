<?php
namespace App\Helper;
use DB;

class Acceso
{
    //---------------------------usuario----------------------------
    public static  $crearUsuario           =  "crear usuario";
    public static  $listarUsuario          =  'listar usuario';
    public static  $actualizarUsuario      =  'actualizar usuario';
    public static  $eliminarUsuario        =  'eliminar usuario';
    
    //-----------------categoria--------------------
    public static  $crearCategoria       =  'crear categoria';
    public static  $listarCategoria      =  'listar categoria';
    public static  $actualizarCategoria  =  'actualizar categoria';
    public static  $eliminarCategoria    =  'eliminar categoria';
    public static  $insertarImagenCategoria  =  'insertar imagen de categoria';

    //-----------------productos--------------------
    public static  $crearProducto       =  'crear producto';
    public static  $listarProducto      =  'listar producto';
    public static  $actualizarProducto  =  'actualizar producto';
    public static  $eliminarProducto    =  'eliminar producto';

    //-----------------modulos--------------------
    public static  $crearModulo       =  'crear modulo';
    public static  $listarModulo      =  'listar modulo';
    public static  $actualizarModulo  =  'actualizar modulo';
    public static  $eliminarModulo    =  'eliminar modulo';

    //-----------------accesos--------------------
    public static $crearAcceso       =  'crear acceso';
    public static $listarAcceso      =  'listar acceso';
    public static $actualizarAcceso  =  'actualizar acceso';
    public static $eliminarAcceso    =  'eliminar acceso';

    //-----------------permisos--------------------
    public static $crearPermiso       =  'crear permiso';
    public static $listarCantidadPermisoPorModulo      =  'listar cantidad de permiso por modulo';
    public static $listarPermiso      =  'listar permiso';
    public static $actualizarPermiso  =  'actualizar permiso';
    public static $eliminarPermiso    =  'eliminar permiso';

    //-----------------roles--------------------
    public static $listarRol      =  'listar rol';
    public static $actualizarRol  =  'actualizar rol';


    //getters
    //---------------------------usuario----------------------------
    public static  function getCrearUsuario ()
    {
        return (self::$crearUsuario);
    }
    public static  function getListarUsuario ()
    {
        return (self::$listarUsuario);
    }
    public static  function getActualizarUsuario ()
    {
        return (self::$actualizarModulo);
    }
    public static  function getEliminarUsuario ()
    {
        return (self::$eliminarUsuario);
    }
    
    //---------------------------categoria----------------------------
    public static  function getCrearCategoria ()
    {
        return (self::$crearCategoria);
    }
    public static  function getListarCategoria ()
    {
        return (self::$listarCategoria);
    }
    public static  function getActualizarCategoria()
    {
        return (self::$actualizarCategoria);
    }
    public static  function getEliminarCategoria ()
    {
        return (self::$eliminarCategoria);
    }
    public static  function getInsertarImagenCategoria ()
    {
        return (self::$insertarImagenCategoria);
    }
    //---------------------------producto----------------------------
    public static  function getCrearProducto ()
    {
        return (self::$crearProducto);
    }
    public static  function getlistarProducto ()
    {
        return (self::$listarProducto);
    }
    public static  function getActualizarProducto ()
    {
        return (self::$actualizarProducto);
    }
    public static  function getEliminarProducto ()
    {
        return (self::$eliminarProducto);
    }
    //---------------------------modulo----------------------------
    public static  function getCrearModulo ()
    {
        return (self::$crearModulo);
    }
    public static  function getlistarModulo ()
    {
        return (self::$listarModulo);
    }
    public static  function getActualizarModulo ()
    {
        return (self::$actualizarModulo);
    }
    public static  function getEliminarModulo ()
    {
        return (self::$eliminarModulo);
    }
      //---------------------------accesos----------------------------
    
      public static  function getlistarAcceso ()
      {
          return (self::$listarAcceso);
      }
      public static  function getActualizarAcceso ()
      {
          return (self::$actualizarAcceso);
      }
     
        //---------------------------permisos----------------------------
    public static  function getCrearPermiso ()
    {
        return (self::$crearPermiso);
    }
    public static  function getlistarPermiso ()
    {
        return (self::$listarPermiso);
    }
    public static  function getlistarCantidadPermisoPorModulo ()
    {
        return (self::$listarCantidadPermisoPorModulo);
    }
    public static  function getActualizarPermiso ()
    {
        return (self::$actualizarPermiso);
    }
    public static  function getEliminarPermiso ()
    {
        return (self::$eliminarPermiso);
    }
      //---------------------------roles----------------------------
      public static  function getCrearRol ()
      {
          return (self::$crearRol);
      }
      public static  function getlistarRol ()
      {
          return (self::$listarRol);
      }
      public static  function getActualizarRol ()
      {
          return (self::$actualizarRol);
      }
      public static  function getEliminarRol ()
      {
          return (self::$eliminarRol);
      }

    public static  function hasPermission($permiso){
        $user = auth('api')->user();
        // return $user->id;
        $hasPermission = DB::table('role_permissions')
                ->join('roles','role_permissions.role_id','=','roles.id')
                ->join('permissions','role_permissions.permission_id','=','permissions.id')
                ->join('modules','permissions.module_id','=','modules.id')
                ->join('users','roles.id','=','users.role_id')
                ->where('users.id',$user->id)
                ->where('permissions.name', '=',$permiso)
                ->exists();
                // ->get(['permissions.*']);
        return  $hasPermission;
    }
}