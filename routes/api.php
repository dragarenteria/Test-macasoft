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
Route::group(['prefix' => 'auth'], function () {
    //ruta para autenticar al usuario que intenta acceder a la api
    Route::post('users/login', 'UserController@login');

    //ruta para que solo accedan los administradores
Route::group(['middleware' => ['role:Administrador','auth:api']], function() {
    //ruta de usuarios
    Route::apiResource('users', 'UserController');

    Route::get('usersNombre/{name}', 'UserController@user_nombre');

    //ruta de roles
    Route::apiresource('roles', 'RoleController',[
        'except' => ['edit', 'create','update']
    ]);

});
});


// Route::group('middleware','auth:api', function () {
   
// Route::apiResource('users', 'UserController');
    
// });