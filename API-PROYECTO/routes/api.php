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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Usuarios
Route::group(['prefix' => 'v1'],function(){
	//RUTAS DE USUARIOS
	Route::post('login', 'LoginController@login');
    Route::resource('usuarios','usuariosController');
    Route::resource('escuelas','escuelaController');
}); 