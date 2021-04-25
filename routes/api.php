<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('test', function (){
//     return response([1,2,3,4],200);
// });


//=====================para loguearse y registrarse======================
Route::post('/login','AuthController@login');
Route::post('/register','AuthController@register');
Route::post('/forgot','AuthController@forgot');
Route::post('/reset','AuthController@reset');

Route::post('/pruebaEmail','AuthController@pruebaEnvioEmail');
//=======================================================================
 //=============================== main page=========================================
    /**
     * page product Detail
     */
    Route::get('/fileOfProduct/{productId}','ProductDetailController@getFileOfProduct');
    Route::get('/productDetail/{productId}','ProductDetailController@getProductDetail');
    // Route::get('/getRelatedProductbyCategoryId/{id}','ProductDetailController@getRelatedProductbyCategoryId');
//==================================================================================


/**
 * page search everithing in the main page
 */
    Route::get('/getchildCategoryById/{id}','SearchController@getchildCategoryById');
    Route::get('/getRelatedProductbyCategoryId/{id}','SearchController@getRelatedProductbyCategoryId');
    Route::get('/getRelatedProductAndCategorybySearch/{search}','SearchController@searchProduct');
//==================================================================================

// page carrito
// ======================inserta o actualiza los datos==========================
    Route::get('/carrito/{pedodo_id}','CarritoController@carritoByPedidoId');
    Route::post('/carrito','CarritoController@createOrUpdate');
    Route::post('/carrito/{product_id}/{pedido_id}','CarritoController@destroy');


//====================ruta de subida de caracteristica============================
    Route::post('/characteristic','CharacteristicController@store');
    Route::post('/characteristic/{id}','CharacteristicController@update');

    Route::get('/characteristic/{product_id}','CharacteristicController@getByProductId');
    Route::delete('/characteristic/{id}','CharacteristicController@destroy');


    //===================================ruta categoria=========================================
    Route::get('/categoryRandom','CategoryController@getRandomCategory');
    Route::get('/getchildCategory','CategoryController@getchildCategory');
    Route::get('/categoryParent','CategoryController@categoryParent');


    //===================================ruta producto========================================
    Route::get('/productRandom','ProductController@getRandomProduct');

    //=====================================pedido===============================================
    Route::get('/pedidoByUserId','PedidoController@pedidoByUserId');
    Route::get('/pedidoById/{id}','PedidoController@pedidoById');
    Route::post('/pedido','PedidoController@store');

    // ============================ruta de direcciones de envio ====================================
    Route::get('/direction','DirectionController@getDirectionsByUserId');


Route::middleware('auth:api')->group(function(){
    Route::get('/user','UserController@index');
    Route::post('/user','UserController@create');
    Route::post('/user/{id}','UserController@update');

    Route::post('/logout','AuthController@logout');
    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });

    //====================ruta de productos=============================
        Route::get('/product','ProductController@index');
        Route::get('/product/{id}','ProductController@getById');
        Route::post('/product','ProductController@store');
        Route::post('/product/{id}','ProductController@update');
        Route::delete('/product/{category}','ProductController@destroy');
    //==================================================================

    //==============================pedido==============================
        Route::get('/pedidoByIdAdmin/{id}','PedidoController@pedidoByIdAdmin');
        Route::post('/pedidoSearch','PedidoController@pedidoSearch');
        Route::post('/pedido/{id}','PedidoController@update');
        Route::delete('/pedido/{id}','PedidoController@destroy');
        Route::post('/productAccordingPedido','ProductController@updateProductAccoodingPedido');
        Route::get('/tusPedidoConfirmado','PedidoController@tusPedidoConfirmadosByUserId');
        Route::post('/motivoAnularPedido','PedidoController@motivoAnularPedido');


    //==================================================================

    //===================rutas de categoria============================
        Route::get('/category','CategoryController@index');
        Route::post('/category','CategoryController@store');
        // Route::post('/category/{category}','CategoryController@update');
        Route::post('/category/{id}','CategoryController@update');
        Route::delete('/category/{category}','CategoryController@destroy');
        Route::post('/addParent','CategoryController@addParent');
        Route::get('/category/{category}','CategoryController@byId');


    //==================================================================

    //ejemplos
        Route::get('/ParentCategory/{id}','CategoryController@getParentCategory');

    //====================ruta de attributos============================
        Route::post('/attribute','AttributeController@store');
    //==================================================================

    //======================ruta de valores=============================
        Route::get('/value','ValueController@index');
        Route::post('/value','ValueController@store');
    //==================================================================

    //====================ruta de blend attribute value==========================
        Route::post('/blendAttributeValue','BlendAttributeValueController@store');
    //==================================================================

    //====================ruta de attributo valores=============================
        Route::post('/attributeValue','AttributeValueController@store');
    //=========================================================================

    //====================ruta de estados de producto==========================
        Route::get('/statusProduct','StatusProductController@index');
    //==================================================================

    //====================ruta de subida de imagenes admin============================
        Route::post('/file','FileController@store');
        Route::post('/file/{id}','FileController@update');
        Route::get('/file/{productId}','FileController@getByProductId');
        Route::delete('/file/{id}','FileController@destroy');

    //=================================================================================
    // ============================ruta de direcciones de envio ====================================
    Route::post('/direction','DirectionController@store');

    //=================================================================================

    //=========================seguridad=================================
    //===================rutas de modulo=================================
        Route::get('/module','ModuleController@index');
        Route::get('/module/{id}','ModuleController@moduleById');
        Route::post('/module','ModuleController@store');
        Route::post('/module/{id}','ModuleController@update');
        Route::delete('/module/{id}','ModuleController@destroy');

    //====================================================================
    //===================rutas de permiso=================================
        Route::get('/permission','PermissionController@index');
        Route::get('/permission/{id}','PermissionController@permissionById');
        Route::get('/permisosPorModulo/{idModulo}','PermissionController@ver');
        Route::post('/permission','PermissionController@store');
        Route::post('/permission/{id}','PermissionController@update');
        Route::delete('/permission/{id}','PermissionController@destroy');
        Route::post('/hasThisPermission','PermissionController@hasThisPermission');

    //====================================================================
    //=======================rutas de roles================================
        Route::get('/role','RoleController@index');
        Route::get('/role/{id}','RoleController@roleById');
        Route::post('/role','RoleController@store');
        Route::post('/role/{id}','RoleController@update');
        Route::delete('/role/{id}','RoleController@destroy');
    //======================================================================

    //====================rutas de roles_permiso============================
        Route::get('/rolepermission','RolePermissionController@index');
        Route::get('/accesPermissionsByUserToken','RolePermissionController@accesPermissionsByUserToken');
        Route::post('/accesPermissions/{idRole}','RolePermissionController@accesPermissions');
        Route::post('/permissionsWithoutAcces/{idRole}','RolePermissionController@permissionsWithoutAcces');


        Route::post('/addRolepermission/{idRole}','RolePermissionController@store');
        Route::post('/removeRolepermission/{idRole}','RolePermissionController@destroy');
        Route::get('/rolepermission/module','RolePermissionController@getAllModule');
    //=======================================================================
    //========================================================================
        Route::get('/getUserByToken','UserController@getUserByToken');
});
