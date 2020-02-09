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
//=======================================================================
Route::middleware('auth:api')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout','AuthController@logout');
    
    //====================ruta de productos=============================
        Route::get('/product/{id}','ProductController@getById');
        Route::post('/product','ProductController@store');
        Route::post('/product/{id}','ProductController@update');
        Route::delete('/product/{category}', 'ProductController@destroy');
        Route::get('/productRandom','ProductController@getRandomProduct');
    //==================================================================

    //==============================pedido==============================
        Route::get('/pedidoByUserId','PedidoController@pedidoByUserId');
        Route::post('/pedido','PedidoController@store');
        Route::get('/product','ProductController@index');
        Route::post('/pedido/{id}','PedidoController@update');
        Route::post('/productAccordingPedido','ProductController@updateProductAccoodingPedido');
    //==================================================================

    //===================rutas de categoria============================
        Route::get('/category','CategoryController@index');
        Route::get('/categoryParent','CategoryController@categoryParent');
        Route::post('/category','CategoryController@store');
        // Route::post('/category/{category}','CategoryController@update');
        Route::post('/category/{id}','CategoryController@update');
        Route::delete('/category/{category}', 'CategoryController@destroy');
        Route::post('/addParent', 'CategoryController@addParent');
        Route::get('/category/{category}','CategoryController@byId');
        Route::get('/categoryRandom','CategoryController@getRandomCategory');
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
    //=================================================================================
    //=============================== main page=========================================
    /**
     * page product Detail
     */
        Route::get('/fileOfProduct/{productId}','ProductDetailController@getFileOfProduct');
        Route::get('/productDetail/{productId}','ProductDetailController@getProductDetail');
        // Route::get('/getRelatedProductbyCategoryId/{id}','ProductDetailController@getRelatedProductbyCategoryId');
    //==================================================================================

    /**
     * page categories
     */
        Route::get('/getchildCategory','CategoriesController@getchildCategory');
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
        Route::delete('/carrito/{id}/{pedido_id}','CarritoController@destroy');
        

    //====================ruta de subida de caracteristica============================
        Route::post('/characteristic','CharacteristicController@store');
        Route::post('/characteristic/{id}','CharacteristicController@update');

        Route::get('/characteristic/{product_id}','CharacteristicController@getByProductId');
        Route::delete('/characteristic/{id}','CharacteristicController@destroy');

    // ============================ruta de direcciones de envio ====================================
    Route::get('/direction','DirectionController@getDirectionsByUserId');
    Route::post('/direction','DirectionController@store');
});










