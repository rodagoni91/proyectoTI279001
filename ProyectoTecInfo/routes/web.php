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
    //return view('welcome');
    return redirect('/login');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cerrarSesion','HomeController@cerrarSesion');
//Rutas de administracion de usuarios
Route::get('/admiUsuarios','HomeController@admiUsuarios')->name('admiUsuarios');
Route::post('/insertarUsuario','HomeController@insertarUsuario')->name('insertarUsuario');
Route::post('/eliminarUsuario','HomeController@eliminarUsuario')->name('eliminarUsuario');
Route::get('/actualizarUsuario/{id}','HomeController@vistaActualizarUsuario')->name('vistaActualizarUsuario');
Route::post('/actualizarUsuario','HomeController@actualizarUsuario')->name('actualizarUsuario');
//Rutas de administracion de escuela
Route::get('/admiEscuelas','HomeController@admiEscuelas')->name('admiEscuelas');
Route::post('/insertarEscuela','HomeController@insertarEscuela')->name('insertarEscuela');
Route::post('/eliminarEscuela','HomeController@eliminarEscuela')->name('eliminarEscuela');
Route::get('/actualizarEscuela/{id}','HomeController@vistaActualizarEscuela')->name('vistaActualizarEscuela');
Route::post('/actualizarEscuela','HomeController@actualizarEscuela')->name('actualizarEscuela');
//Rutas de administracion de profesores
Route::get('/admiProfesores','HomeController@admiProfesores')->name('admiProfesores');
Route::post('/insertarProfesor','HomeController@insertarProfesor')->name('insertarProfesor');
Route::post('/eliminarProfesor','HomeController@eliminarProfesor')->name('eliminarProfesor');
Route::get('/actualizarProfesor/{id}','HomeController@vistaActualizarProfesor')->name('vistaActualizarProfesor');
Route::post('/actualizarProfesor','HomeController@actualizarProfesor')->name('actualizarProfesor');