<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


// Route::middleware(['auth'])->group(function(){
    // Route::group(['prefix' => 'admin/'], function () {
    //     Route::get('/role', function () {
    //         return view('administration.roles.index');
    //     });
        
    // Route::get('/user', function () {
    //     return view('administration.users.index');
    // });
    //     // Route::resource('/user','UserController@home');
    // });
// });


// Route::middleware(['auth:api'])->group(function(){
//     Route::group(['prefix' => 'admin/'], function() {
        Route::resource('api/user', 'UserController');
        // Route::resource('invoice', 'InvoiceController');
//     });
// });


// Route::get('/test',function () {
//     return response()->json([
//         'user'=>[
//             'first-name'=>'kevin',
//             'last-name'=>'delgadillo'
//         ]
//     ]);
// });

