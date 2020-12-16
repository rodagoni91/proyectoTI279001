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
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
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
//Rutas de administracion de Cursos
Route::get('/administracionCursos','HomeController@administracionCursos')->name('administracionCursos');
Route::post('/insertarCurso','HomeController@insertarCurso')->name('insertarCurso');
Route::get('/actualizarCurso/{idCurso}','HomeController@vistaActualizarCurso')->name('vistaActualizarCurso');
Route::post('/actualizarCurso','HomeController@actualizarCurso')->name('actualizarCurso');
Route::post('/eliminarCurso','HomeController@eliminarCurso')->name('eliminarCurso');
Route::get('/detalleCurso/{idCurso}','HomeController@detalleCurso')->name('detalleCurso');
Route::post('/asignarProfesor','HomeController@asignarProfesor')->name('asignarProfesor');
Route::post('/eliminarAsignacion','HomeController@eliminarAsignacion')->name('eliminarAsignacion');
Route::get('/actualizarAsignacion/{idDetalle}','HomeController@vistaActualizarAsignacion')->name('vistaActualizarAsignacion');
Route::post('/actualizarAsignacion','HomeController@actualizarAsignacion')->name('actualizarAsignacion');
//Rutas de administracion de alumnos
Route::get('/admiAlumnos','HomeController@admiAlumnos')->name('admiAlumnos');
Route::post('/insertarAlumno','HomeController@insertarAlumno')->name('insertarAlumno');
Route::post('/eliminarAlumno','HomeController@eliminarAlumno')->name('eliminarAlumno');
Route::get('/actualizarAlumno/{id}','HomeController@vistaActualizarAlumno')->name('vistaActualizarAlumno');
Route::post('/actualizarAlumno','HomeController@actualizarAlumno')->name('actualizarAlumno');
//Rutas de profesores
Route::get('/admiTareas','HomeController@admiTareas')->name('admiTareas');
Route::get('/cursosEscuela','HomeController@cursosEscuela')->name('cursosEscuela');
Route::post('/crearTarea','HomeController@crearTarea')->name('crearTarea');
Route::get('/detalleMiCurso/{idCurso}','HomeController@detalleMiCurso')->name('detalleMiCurso');
Route::get('/detalleAlumno/{idAlumno}','HomeController@detalleAlumno')->name('detalleAlumno');  
Route::get('/vistaActualizarTarea/{idTarea}','HomeController@vistaActualizarTarea')->name('vistaActualizarTarea');
Route::get('/detallesTarea/{idTarea}','HomeController@detallesTarea')->name('detallesTarea');
Route::post('/actualizarTarea','HomeController@actualizarTarea')->name('actualizarTarea');
Route::post('/calificarTarea','HomeController@calificarTarea')->name('calificarTarea');
//Exportar excel
Route::get('/exportarXLS', function () {
    return Excel::download(new ProductsExport, 'listaAsistencia.xls');
});
//Rutas de alumnos
Route::post('/inscribirCurso','HomeController@inscribirCurso')->name('inscribirCurso');
Route::get('/admiCursosEscuela','HomeController@admiCursosEscuela')->name('admiCursosEscuela');
Route::get('/misCursosInscritos','HomeController@misCursosInscritos')->name('misCursosInscritos');
Route::get('/misTareas','HomeController@misTareas')->name('misTareas');
Route::post('/entregarTarea','HomeController@entregarTarea')->name('entregarTarea');
Route::get('/detallesCurso/{idCurso}','HomeController@detallesCurso')->name('detallesCurso');
Route::get('/detalleTarea/{idTarea}','HomeController@detalleTarea')->name('detalleTarea');
Route::post('/tomarAsistencia','HomeController@tomarAsistencia')->name('tomarAsistencia');