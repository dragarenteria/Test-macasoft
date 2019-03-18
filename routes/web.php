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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['role:Administrador', 'auth']], function () {
    //rutas del usuario
    Route::resource('users', 'UserController',[
        'except' => ['edit', 'create']
    ]);
    Route::get('viewusers', 'UserController@view_user')->name('verUsuario');

        //rutas de roles
    Route::resource('roles', 'RoleController',[
        'except' => ['edit', 'create']
    ]);
    Route::get('viewroles', 'RoleController@view_role')->name('verRol');
    Route::get('roles.view', 'RoleController@index_selects');

    
});

Route::get('/home', 'HomeController@index')->name('home');



