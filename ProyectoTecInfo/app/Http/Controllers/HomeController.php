<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Session;
use Carbon\Carbon;
//Importacion de modelos
use App\TipoUsuario;
use App\User;
use App\Escuela;
use App\Profesor;
use App\Curso;
use App\DetalleCurso;
use App\Alumno;
use App\Inscripcion;
use App\Tareas;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->idTipoUsuario == 3){
            $escuela = Escuela::where('idUsuario','=', Auth::user()->id)->first();
            return view('home')->with('escuela',$escuela);
        }
        else{
            return view('home');
        }

        
    }

    public function cerrarSesion()
    {
        Auth::logout();
        return redirect('/login');
    }

    //Funciones de administracion de usuarios
    public function admiUsuarios(){
        if(Auth::user()->idTipoUsuario == 1){
            $usuarios = User::join('TipoUsuario','TipoUsuario.idTipoUsuario','=','users.idTipoUsuario')
            ->select('users.*','TipoUsuario.nombre as nombretipousuario')
            ->where('users.idTipoUsuario','=',1)->orWhere('users.idTipoUsuario','=',2)
            ->get();

            return view('admiUsuarios')->with('usuarios',$usuarios);
        }
        else{
            return redirect('/home');
        }

    }

    public function insertarUsuario(Request $request){

        if(Auth::user()->idTipoUsuario == 1){
            $validator = Validator::make($request->all(), [
                'idTipoUsuario' => 'required|integer',
                'name'=> 'required|string',
                
                'phone' => 'required|string',
                'email' => 'required|string|email|max:255|unique:users',

            ]);
            if ($validator->fails())
            {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', 'Hubo un error, favor de checar los campos');
                return redirect('/admiUsuarios')->withInput()->withErrors($validator);
            }
            $usuario = new User;
            $usuario->idTipoUsuario = filter_var($request->idTipoUsuario,FILTER_SANITIZE_NUMBER_INT);
            $usuario->name = filter_var($request->name, FILTER_SANITIZE_STRING);
            $usuario->email = filter_var($request->email,FILTER_SANITIZE_EMAIL);
            $usuario->phone = filter_var($request->phone,FILTER_SANITIZE_STRING);
            $usuario->password = bcrypt("password");
            $usuario->created_at = Carbon::now()->format('Y-m-d h:i:s');
            $usuario->save();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Usuario Agregado Correctamente.');
            return redirect('/admiUsuarios');   
        }
        else{
            return redirect('/home');
        }
    }

    public function eliminarUsuario(Request $request){
        if(Auth::user()->idTipoUsuario == 1){
            $usuario = User::find($request->idUsuario);
            $usuario->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Usuario Eliminado Correctamente.');
            return redirect('/admiUsuarios');
        }
        else{
            return redirect('/home');
        }  
    }

    public function vistaActualizarUsuario($id){
        if(Auth::user()->idTipoUsuario == 1){
            $usuario = User::find($id);
            return view('actualizarUsuario')->with('usuario',$usuario);
        }
        else{
            return redirect('/home');
        }  
    }

    public function actualizarUsuario(Request $request){
        if(Auth::user()->idTipoUsuario == 1){
            $usuario = User::find($request->idUsuario);   
            $validator = Validator::make($request->all(), [
                //'idTipoUsuario' => 'required|integer',
                'name'=> 'required|string',
            ]);
            if ($validator->fails())
            {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', 'Hubo un error, favor de checar los campos');
                return redirect('/actualizarUsuario/'.$request->idUsuario)->withInput()->withErrors($validator);
            }
            //$usuario->idTipoUsuario = filter_var($request->idTipoUsuario,FILTER_SANITIZE_NUMBER_INT);
            $usuario->name = filter_var($request->name, FILTER_SANITIZE_STRING);
            $usuario->email = filter_var($request->email,FILTER_SANITIZE_EMAIL);
            $usuario->phone = filter_var($request->Telefono,FILTER_SANITIZE_STRING);
            $usuario->updated_at = Carbon::now()->format('Y-m-d h:i:s');
            $usuario->save();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Usuario Actualizado Correctamente.');
            return redirect('/actualizarUsuario/'.$request->idUsuario);   
        }
        else{
            return redirect('/home');
        }  
    }

    //Funciones de administracion de escuelas
    public function admiEscuelas(){
        if(Auth::user()->idTipoUsuario == 1 || Auth::user()->idTipoUsuario == 2){
            $escuelas = Escuela::join('users','users.id','=','Escuela.idUsuario')
            ->join('TipoUsuario','TipoUsuario.idTipoUsuario','=','users.idTipoUsuario')
            ->select('Escuela.*','users.*','users.name as nombreEscuela','TipoUsuario.nombre as nombretipousuario')
            ->get();
            return view('administracionEscuelas')->with('escuelas',$escuelas);
        }
        else{
            return redirect('/home');
        }  
    }

    public function insertarEscuela(Request $request){
        if(Auth::user()->idTipoUsuario == 1 || Auth::user()->idTipoUsuario == 2){
            $validator = Validator::make($request->all(), [
                'name'=>'required|string',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string',
                'Director' => 'required|string|max:255',
                'Telefono' => 'required|string|max:255',
                'direccion' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', 'Hubo un error, favor de checar los campos');
                return redirect('/admiEscuelas')->withInput()->withErrors($validator);
            } 
            $usuario = new User;
            $usuario->idTipoUsuario = 3;
            $usuario->name = filter_var($request->name, FILTER_SANITIZE_STRING);
            $usuario->email = filter_var($request->email,FILTER_SANITIZE_EMAIL);
            $usuario->phone = filter_var($request->Telefono,FILTER_SANITIZE_STRING);
            $usuario->password = filter_var(bcrypt("password"), FILTER_SANITIZE_STRING);
            $usuario->created_at = Carbon::now()->format('Y-m-d h:i:s');
            $usuario->save();
            $escuela = new Escuela;
            $escuela->idUsuario = $usuario->id;
            $escuela->Direccion = filter_var($request->direccion,FILTER_SANITIZE_STRING);
            $escuela->Telefono = filter_var($request->Telefono,FILTER_SANITIZE_STRING);
            $escuela->Director = filter_var($request->Director,FILTER_SANITIZE_STRING);
            $escuela->created_at = Carbon::now()->format('Y-m-d h:i:s');
            $escuela->save();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Escuela Agregado Correctamente.');
            return redirect('/admiEscuelas');  
        }
        else{
            return redirect('/home');
        }  
    }

    public function eliminarEscuela(Request $request){
        if(Auth::user()->idTipoUsuario == 1 || Auth::user()->idTipoUsuario == 2){
            $escuela = Escuela::find($request->idEscuela);
            $usuario = User::find($escuela->idUsuario);
            $escuela->delete();
            $usuario->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Escuela Eliminada Correctamente.');
            return redirect('/admiEscuelas');   
        }
        else{
            return redirect('/home');
        }  
    }

    public function vistaActualizarEscuela($id){
        if(Auth::user()->idTipoUsuario == 1 || Auth::user()->idTipoUsuario == 2){
            $escuela = Escuela::join('users','users.id','=','Escuela.idUsuario')
            ->join('TipoUsuario','TipoUsuario.idTipoUsuario','=','users.idTipoUsuario')
            ->select('Escuela.*','users.*','users.name as nombreEscuela','TipoUsuario.nombre as nombretipousuario')
            ->where('Escuela.idEscuela','=',$id)
            ->first();
            return view('actualizarEscuela')->with('escuela',$escuela);
        }
        if(Auth::user()->idTipoUsuario == 3){
            $escuela = Escuela::join('users','users.id','=','Escuela.idUsuario')
            ->join('TipoUsuario','TipoUsuario.idTipoUsuario','=','users.idTipoUsuario')
            ->select('Escuela.*','users.*','users.name as nombreEscuela','TipoUsuario.nombre as nombretipousuario')
            ->where('users.id','=',Auth::user()->id)
            ->first();
            return view('actualizarEscuela')->with('escuela',$escuela);
        }
        else{
            return redirect('/home');
        }  
    }

    public function actualizarEscuela(Request $request){
        if(Auth::user()->idTipoUsuario == 1 || Auth::user()->idTipoUsuario == 2 || Auth::user()->idTipoUsuario == 3){
            $escuela = Escuela::find($request->idEscuela);
            $usuario = User::find($escuela->idUsuario);
            $validator = Validator::make($request->all(), [
                'name'=>'required|string',  
                'Director' => 'required|string|max:255',
                'Telefono' => 'required|string|max:255',
                'direccion' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', 'Hubo un error, favor de checar los campos');
                return redirect('/actualizarEscuela/'.$request->idEscuela)->withInput()->withErrors($validator);
            } 
            $usuario->idTipoUsuario = 3;
            $usuario->name = filter_var($request->name, FILTER_SANITIZE_STRING);
            $usuario->phone = filter_var($request->Telefono,FILTER_SANITIZE_STRING);
            $usuario->created_at = Carbon::now()->format('Y-m-d h:i:s');
            $usuario->save();
            $escuela->Direccion = filter_var($request->direccion,FILTER_SANITIZE_STRING);
            $escuela->Telefono = filter_var($request->Telefono,FILTER_SANITIZE_STRING);
            $escuela->Director = filter_var($request->Director,FILTER_SANITIZE_STRING);
            $escuela->created_at = Carbon::now()->format('Y-m-d h:i:s');
            $escuela->save();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Escuela Actualizada Correctamente.');
            return redirect('/actualizarEscuela/'.$request->idEscuela);
        }
        else{
            return redirect('/home');
        }  
    }

    //Funciones de administracion de profesores
    public function admiProfesores(){
        if(Auth::user()->idTipoUsuario == 3){
            $escuela = Escuela::where('idUsuario','=', Auth::user()->id)->first();
            $profesores = Profesor::join('users','users.id','=','Profesor.idUsuario')
            ->select('Profesor.*','users.*')
            ->where('users.idTipoUsuario','=',4)
            ->where('Profesor.idEscuela','=',$escuela->idEscuela)
            ->get();

            return view('admiProfesores')->with('profesores',$profesores)->with('escuela',$escuela);
        }
        else{
            return redirect('/home');
        }  
    }

    public function insertarProfesor(Request $request){
        if(Auth::user()->idTipoUsuario == 3){
            $validator = Validator::make($request->all(), [
                'name'=> 'required|string',
                'phone' => 'required|string',
                'email' => 'required|string|email|max:255|unique:users',
                'Direccion' => 'required|string',
            ]);
            if ($validator->fails())
            {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', 'Hubo un error, favor de checar los campos');
                return redirect('/admiProfesores')->withInput()->withErrors($validator);
            }
            $usuario = new User;
            $usuario->idTipoUsuario = 4;
            $usuario->name = filter_var($request->name, FILTER_SANITIZE_STRING);
            $usuario->email = filter_var($request->email,FILTER_SANITIZE_EMAIL);
            $usuario->phone = filter_var($request->phone,FILTER_SANITIZE_STRING);
            $usuario->password = bcrypt("password");
            $usuario->created_at = Carbon::now()->format('Y-m-d h:i:s');
            $usuario->save();
            $profesor = new Profesor;
            $profesor->idUsuario = $usuario->id;
            $profesor->idEscuela = $request->idEscuela;
            $profesor->Direccion = filter_var($request->Direccion,FILTER_SANITIZE_STRING);
            $profesor->Telefono = filter_var($request->Telefono,FILTER_SANITIZE_STRING); 
            $profesor->created_at = Carbon::now()->format('Y-m-d h:i:s');
            $profesor->save();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Profesor Agregado Correctamente.');
            return redirect('/admiProfesores'); 
        }
        else{
            return redirect('/admiProfesores');
        }   
    }

    public function eliminarProfesor(Request $request){
        if(Auth::user()->idTipoUsuario == 3){
            $profesor = Profesor::find($request->idProfesor);
            $usuario = User::find($profesor->idUsuario);
            $usuario->delete();
            $profesor->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Profesor Eliminado Correctamente.');
            return redirect('/admiProfesores');   
        }
        else{
            return redirect('/admiProfesores');
        }   
    }

    public function vistaActualizarProfesor($idProfesor){
        if(Auth::user()->idTipoUsuario == 3){
            $escuela = Escuela::where('idUsuario','=', Auth::user()->id)->first();
            $profesor = Profesor::join('users','users.id','=','Profesor.idUsuario')
            ->select('Profesor.*','users.*')
            ->where('Profesor.idProfesor','=',$idProfesor)
            ->first();
            if($profesor->idEscuela == $escuela->idEscuela){
                return view('actualizarProfesor')->with('profesor',$profesor)->with('escuela',$escuela);
            }
            else{
                return redirect('/admiProfesores');
            }   
        }
        else{
            return redirect('/admiProfesores');
        }   
    }

    public function actualizarProfesor(Request $request){
        if(Auth::user()->idTipoUsuario == 3){
            $profesor = Profesor::find($request->idProfesor);
            $usuario = User::find($profesor->idUsuario);

            $validator = Validator::make($request->all(), [
                'name'=> 'required|string',
                'Telefono' => 'required|string',
                'Direccion' => 'required|string',
            ]);
            if ($validator->fails())
            {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', 'Hubo un error, favor de checar los campos');
                return redirect('/actualizarProfesor/'.$request->idProfesor)->withInput()->withErrors($validator);
            }
            
            $usuario->name = filter_var($request->name, FILTER_SANITIZE_STRING);
            $usuario->phone = filter_var($request->Telefono,FILTER_SANITIZE_STRING);
            $usuario->updated_at = Carbon::now()->format('Y-m-d h:i:s');
            $usuario->save();
            $profesor->Direccion = filter_var($request->Direccion,FILTER_SANITIZE_STRING);
            $profesor->Telefono = filter_var($request->Telefono,FILTER_SANITIZE_STRING); 
            $profesor->save();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Profesor Actualizado Correctamente.');
            return redirect('/actualizarProfesor/'.$request->idProfesor); 
        }
        else{
            return redirect('/home');
        }     
    }

    //Funciones de administracion de cursos
    public function administracionCursos(){
        if(Auth::user()->idTipoUsuario == 3){
            $escuela = Escuela::where('idUsuario','=', Auth::user()->id)->first();
            $cursos = Curso::where('idEscuela','=', $escuela->idEscuela)->get();
            $curso = Curso::where('idEscuela','=',$escuela)->get();
            return view('admiCursos')->with('cursos',$cursos)->with('escuela',$escuela);
        }
        else{
            return redirect('/administracionCursos');
        } 

    }

    public function insertarCurso(Request $request){
        
        if(Auth::user()->idTipoUsuario == 3){
            $validator = Validator::make($request->all(), [
                'Nombre'=> 'required|string',
                'Dias' => 'required|string',
            ]);
            if ($validator->fails())
            {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', 'Hubo un error, favor de checar los campos');
                return redirect('/administracionCursos')->withInput()->withErrors($validator);
            }
           
            $curso = new Curso;
            $curso->idEscuela = $request->idEscuela;
            $curso->NombreCurso = $request->Nombre;
            $curso->Dias = $request->Dias;
            $curso->created_at = Carbon::now()->format('Y-m-d h:i:s');
            $curso->save();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Curso Agregado Correctamente.');
            return redirect('/administracionCursos'); 
        }
        else{
            return redirect('/administracionCursos');
        }   
    }

    public function vistaActualizarCurso($idCurso){
        if(Auth::user()->idTipoUsuario == 3){
            $escuela = Escuela::where('idUsuario','=', Auth::user()->id)->first();
            $curso = Curso::find($idCurso);
            if($curso->idEscuela == $escuela->idEscuela){
                return view('actualizarCurso')->with('curso',$curso)->with('escuela',$escuela);
            }
            else{
                return redirect('/administracionCursos');
            }   
        }
        else{
            return redirect('/administracionCursos');
        }   
    }

    public function actualizarCurso(Request $request){
        if(Auth::user()->idTipoUsuario == 3){
            $curso = Curso::find($request->idCurso);
            $validator = Validator::make($request->all(), [
                'Nombre'=> 'required|string',
                'Dias' => 'required|string',
            ]);
            if ($validator->fails())
            {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', 'Hubo un error, favor de checar los campos');
                return redirect('/administracionCursos')->withInput()->withErrors($validator);
            }
            $curso->NombreCurso = $request->Nombre;
            $curso->Dias = $request->Dias;
            $curso->updated_at = Carbon::now()->format('Y-m-d h:i:s');
            $curso->save();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Curso Actualizado Correctamente.');
            return redirect('/actualizarCurso/'.$request->idCurso); 
        }
        else{
            return redirect('/administracionCursos');
        }   
    }

    public function eliminarCurso(Request $request){
        if(Auth::user()->idTipoUsuario == 3){
            $curso = Curso::find($request->idCurso);
            $curso->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Curso Eliminado Correctamente.');
            return redirect('/administracionCursos');   
        }
        else{
            return redirect('/administracionCursos');
        }   
    }

    public function detalleCurso($id){
        if(Auth::user()->idTipoUsuario == 3){
            $escuela = Escuela::where('idUsuario','=', Auth::user()->id)->first();
            $cursos = Curso::join('DetalleCurso','DetalleCurso.idCurso','=','Curso.idCurso')
            ->join('Profesor','Profesor.idProfesor','=','DetalleCurso.idProfesor')
            ->join('users','users.id','=','Profesor.idUsuario')
            ->select('Curso.*','DetalleCurso.Hora','DetalleCurso.CodigoCurso','users.name as NombreProfesor','DetalleCurso.idDetalleCurso')
            ->where('DetalleCurso.idCurso','=',$id)
            ->where('DetalleCurso.deleted_at','=',null)
            ->get();
            $curso = Curso::find($id);
            $profesores = Profesor::join('users','users.id','=','Profesor.idUsuario')
            ->select('Profesor.*','users.*')
            ->where('users.idTipoUsuario','=',4)
            ->where('Profesor.idEscuela','=',$escuela->idEscuela)
            ->get();
            return view('detalleCurso')->with('cursos',$cursos)->with('curso',$curso)->with('profesores',$profesores)->with('escuela',$escuela);
        }
        else if(Auth::user()->idTipoUsuario == 4){
            $profesor = Profesor::where('idUsuario','=',Auth::user()->id)->first();
            $escuela = Escuela::where('idEscuela','=',$profesor->idEscuela)->first();
            $curso = Curso::find($id);
            $profesores = Profesor::join('users','users.id','=','Profesor.idUsuario')
            ->select('Profesor.*','users.*')
            ->where('users.idTipoUsuario','=',4)
            ->where('Profesor.idEscuela','=',$escuela->idEscuela)
            ->get();
            $cursos = Curso::join('DetalleCurso','DetalleCurso.idCurso','=','Curso.idCurso')
            ->join('Profesor','Profesor.idProfesor','=','DetalleCurso.idProfesor')
            ->join('users','users.id','=','Profesor.idUsuario')
            ->select('Curso.*','DetalleCurso.Hora','DetalleCurso.CodigoCurso','users.name as NombreProfesor','DetalleCurso.idDetalleCurso')
            ->where('DetalleCurso.idCurso','=',$id)
            ->where('DetalleCurso.deleted_at','=',null)
            ->get();
            return view('detallesCurso')->with('cursos',$cursos)->with('curso',$curso)->with('profesores',$profesores)->with('escuela',$escuela);
        }
        else{
            return redirect('/admiProfesores');
        } 
    }

    public function asignarProfesor(Request $request){
        if(Auth::user()->idTipoUsuario == 3){
            $detalle = new DetalleCurso;
            $detalle->idProfesor = $request->idProfesor;
            $detalle->idCurso = $request->idCurso;
            $detalle->Hora = $request->Hora;
            $detalle->CodigoCurso =  substr(md5(microtime()),rand(0,26),6);
            $detalle->save();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Curso Asignado Correctamente.');
            return redirect('/detalleCurso/'.$detalle->idCurso);
        }
        else{
            return redirect('/admiProfesores');
        } 
    }

    public function eliminarAsignacion(Request $request){
        if(Auth::user()->idTipoUsuario == 3){
            $detalle = DetalleCurso::find($request->idDetalleCurso);
            $detalle->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Asignacion Eliminado Correctamente.');
            return redirect('/detalleCurso/'.$request->idCurso); 
        }
        else{
            return redirect('/detalleCurso/'.$request->idCurso);
        }   
    }

    public function vistaActualizarAsignacion($idAsignacion){
        $detalle = DetalleCurso::find($idAsignacion);
        if(Auth::user()->idTipoUsuario == 3){
            $escuela = Escuela::where('idUsuario','=', Auth::user()->id)->first();
            $detalle = Curso::join('DetalleCurso','DetalleCurso.idCurso','=','Curso.idCurso')
            ->join('Profesor','Profesor.idProfesor','=','DetalleCurso.idProfesor')
            ->join('users','users.id','=','Profesor.idUsuario')
            ->select('Curso.*','DetalleCurso.Hora','DetalleCurso.CodigoCurso','users.name as NombreProfesor','DetalleCurso.idDetalleCurso','Profesor.idProfesor')
            ->where('DetalleCurso.idDetalleCurso','=',$idAsignacion)
            ->where('DetalleCurso.deleted_at','=',null)
            ->first();
            $curso = Curso::find($detalle->idCurso);
            $profesores = Profesor::join('users','users.id','=','Profesor.idUsuario')
            ->select('Profesor.*','users.*')
            ->where('users.idTipoUsuario','=',4)
            ->where('Profesor.idEscuela','=',$escuela->idEscuela)
            ->get();
            return view('actualizarAsignacion')->with('detalle',$detalle)->with('curso',$curso)->with('profesores',$profesores)->with('escuela',$escuela);
        }
        else{
            return redirect('/detalleCurso/'.$detalle->idDetalleCurso);
        }   
    }

    public function actualizarAsignacion(Request $request){
        if(Auth::user()->idTipoUsuario == 3){
            $detalle = DetalleCurso::find($request->idDetalle);
            $detalle->idProfesor = $request->idProfesor;
            $detalle->Hora = $request->Hora;
            $detalle->save();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Curso Actualizado Correctamente.');
            return redirect('/actualizarAsignacion/'.$request->idDetalle);
        }
        else{
            return redirect('/admiProfesores');
        } 
    }

    //Funciones de administracion de alumnos
    public function admiAlumnos(){
        if(Auth::user()->idTipoUsuario == 3){
            $escuela = Escuela::where('idUsuario','=', Auth::user()->id)->first();
            $alumnos = Alumno::join('users','users.id','=','Alumno.idUsuario')
            ->select('Alumno.*','users.*')
            ->where('users.idTipoUsuario','=',5)
            ->where('Alumno.idEscuela','=',$escuela->idEscuela)
            ->get();
            return view('administracionAlumnos')->with('alumnos',$alumnos)->with('escuela',$escuela);
        }
        else{
            return redirect('/home');
        }  
    }
    public function insertarAlumno(Request $request){
        if(Auth::user()->idTipoUsuario == 3){
            $validator = Validator::make($request->all(), [
                'name'=> 'required|string|max:255',
                'phone' => 'required|string',
                'email' => 'required|string|email|max:255|unique:users',
                'Direccion' => 'required|string',
            ]);
            if ($validator->fails())
            {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', 'Hubo un error, favor de checar los campos');
                return redirect('/admiAlumnos')->withInput()->withErrors($validator);
            }
            $usuario = new User;
            $usuario->idTipoUsuario = 5;
            $usuario->name = filter_var($request->name, FILTER_SANITIZE_STRING);
            $usuario->email = filter_var($request->email,FILTER_SANITIZE_EMAIL);
            $usuario->phone = filter_var($request->Telefono,FILTER_SANITIZE_STRING);
            $usuario->password = bcrypt("password");
            $usuario->created_at = Carbon::now()->format('Y-m-d h:i:s');
            $usuario->save();
            $alumno = new Alumno;
            $alumno->idUsuario = $usuario->id;
            $alumno->idEscuela = $request->idEscuela;
            $alumno->Direccion = filter_var($request->Direccion,FILTER_SANITIZE_STRING);
            $alumno->Telefono = filter_var($request->Telefono,FILTER_SANITIZE_STRING); 
            $alumno->created_at = Carbon::now()->format('Y-m-d h:i:s');
            $alumno->save();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Alumno Agregado Correctamente.');
            return redirect('/admiAlumnos'); 
        }
        else{
            return redirect('/admiAlumnos');
        }   
    }
    public function eliminarAlumno(Request $request){
        if(Auth::user()->idTipoUsuario == 3){
            $alumno = Alumno::find($request->idAlumno);
            $usuario = User::find($alumno->idUsuario);
            $usuario->delete();
            $alumno->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Alumno Eliminado Correctamente.');
            return redirect('/admiAlumnos');   
        }
        else{
            return redirect('/admiAlumnos');
        }   
    }
    public function vistaActualizarAlumno($idAlumno){
        if(Auth::user()->idTipoUsuario == 3){
            $escuela = Escuela::where('idUsuario','=', Auth::user()->id)->first();
            $alumno = Alumno::join('users','users.id','=','Alumno.idUsuario')
            ->select('Alumno.*','users.*')
            ->where('Alumno.idAlumno','=',$idAlumno)
            ->first();
            if($alumno->idEscuela == $escuela->idEscuela){
                return view('actualizarAlumno')->with('alumno',$alumno)->with('escuela',$escuela);
            }
            else{
                return redirect('/admiAlumnos');
            }   
        }
        else{
            return redirect('/admiAlumnos');
        }   
    }
    public function actualizarAlumno(Request $request){
        if(Auth::user()->idTipoUsuario == 3){
            $alumno = Alumno::find($request->idAlumno);
            $usuario = User::find($alumno->idUsuario);
            $validator = Validator::make($request->all(), [
                'name'=> 'required|string|max:255',
                'Telefono' => 'required|string',
                'Direccion' => 'required|string',
            ]);
            if ($validator->fails())
            {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', 'Hubo un error, favor de checar los campos');
                return redirect('/actualizarAlumno/'.$request->idAlumno)->withInput()->withErrors($validator);
            }
            
            $usuario->name = filter_var($request->name, FILTER_SANITIZE_STRING);
            $usuario->phone = filter_var($request->Telefono,FILTER_SANITIZE_STRING);
            $usuario->updated_at = Carbon::now()->format('Y-m-d h:i:s');
            $usuario->save();
            $alumno->Direccion = filter_var($request->Direccion,FILTER_SANITIZE_STRING);
            $alumno->Telefono = filter_var($request->Telefono,FILTER_SANITIZE_STRING); 
            $alumno->save();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Alumno Actualizado Correctamente.');
            return redirect('/actualizarAlumno/'.$request->idAlumno); 
        }
        else{
            return redirect('/home');
        }     
    }
    //Funciones de profesores
    public function cursosEscuela(){
        $profesor = Profesor::where('idUsuario','=',Auth::user()->id)->first();
        $escuela = Escuela::where('idEscuela','=',$profesor->idEscuela)->first();

        $cursos = Curso::join('DetalleCurso','DetalleCurso.idCurso','=','Curso.idCurso')
        ->where('DetalleCurso.idProfesor','=',$profesor->idProfesor)
        ->select('Curso.*','DetalleCurso.*')->get();

        return view('admiCursos')->with('profesor', $profesor)->with('cursos',$cursos)->with('escuela',$escuela);
    }
    public function detalleMiCurso($idCurso){
        if(Auth::user()->idTipoUsuario == 4){
            $curso = Curso::join('DetalleCurso','DetalleCurso.idCurso','=','Curso.idCurso')
            ->select('DetalleCurso.*','Curso.*')
            ->where('DetalleCurso.idDetalleCurso','=',$idCurso)
            ->first();            
            $profesor = Profesor::where('idUsuario','=',Auth::user()->id)->first();
            $escuela = Escuela::where('idEscuela','=',$profesor->idEscuela)->first();
            $alumnos = Inscripcion::join('Alumno','Alumno.idAlumno','=','Inscripcion.idAlumno')
            ->join('users','users.id','=','Alumno.idUsuario')
            ->where('Inscripcion.idDetalleInscripcion','=', $idCurso)
            ->select('users.name as NombreAlumno','users.email as emailAlumno','Alumno.idAlumno','Inscripcion.created_at as FechaInscripcion')
            ->get();
            return view('detallesCurso')->with('profesor', $profesor)->with('alumnos',$alumnos)->with('escuela',$escuela)->with('curso',$curso);
        }
        else{
            return redirect('/home');
        }
    }
    public function crearTarea(Request $request){
        if(Auth::user()->idTipoUsuario == 4){
            $validator = Validator::make($request->all(), [
                'fecha'=> 'required|string|max:255',
                'hora' => 'required|string',
                'TituloTarea'=> 'required|string|max:255',
                'DescripcionTarea' => 'required|string|max:255',
            ]);
            if ($validator->fails())
            {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', 'Hubo un error, favor de checar los campos');
                return redirect('/admiTareas')->withInput()->withErrors($validator);
            }
            $tarea = new Tareas;
            $tarea->idDetalleCurso = $request->curso;
            $tarea->Fecha = $request->fecha;
            $tarea->Hora = $request->hora;
            $tarea->TituloTarea = $request->name;
            $tarea->DescripcionTarea = $request->descripcion;
            $tarea->created_at = Carbon::now()->format('Y-m-d h:i:s');
            $tarea->save();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Tarea Creada Correctamente.');
            return redirect('/admiTareas');
        }
        else{
            return redirect('/home');
        }
    }
    public function admiTareas(){
        if(Auth::user()->idTipoUsuario == 4){
            $horas = array("8:00 am","9:00 am","12:00 pm","15:00 pm","18:00 pm","19:00 pm","20:00 pm");
            $profesor = Profesor::where('idUsuario','=',Auth::user()->id)->first();
            $escuela = Escuela::where('idEscuela','=',$profesor->idEscuela)->first();
            $tareas = DetalleCurso::join('Tareas','Tareas.idDetalleCurso','=','DetalleCurso.idDetalleCurso')
            ->join('Curso','Curso.idCurso','=','DetalleCurso.idCurso')
            ->join('Profesor','Profesor.idProfesor','=','DetalleCurso.idProfesor')
            ->select('Tareas.*','Curso.*')
            ->where('Profesor.idProfesor','=',$profesor->idProfesor)->get();
            $cursos = Curso::join('DetalleCurso','DetalleCurso.idCurso','=','Curso.idCurso')
            ->where('DetalleCurso.idProfesor','=',$profesor->idProfesor)
            ->select('Curso.*','DetalleCurso.*')->get();    
            return view('admiTareas')->with('profesor',$profesor)->with('escuela',$escuela)->with('tareas',$tareas)->with('horas',$horas)->with('cursos',$cursos);
        }
        else{
            return redirect('/home');
        }
    }
    public function vistaActualizarTarea($id){
        if(Auth::user()->idTipoUsuario){
            $horas = array("8:00 am","9:00 am","12:00 pm","15:00 pm","18:00 pm","19:00 pm","20:00 pm");
            $profesor = Profesor::where('idUsuario','=',Auth::user()->id)->first();
            $escuela = Escuela::where('idEscuela','=',$profesor->idEscuela)->first();
            $tarea = Tarea::find($id);
            return view('actualizarTarea')->with('horas',$horas)->with('profesor',$profesor)->with('escuela',$escuela)->with('tarea',$tarea);
        }
        else{
            return redirect('/home');
        }
    }
    public function actualizarTarea(Request $request){
        if(Auth::user()->idTipoUsuario == 4){
            $tarea = Tarea::where('idTarea','=',$request->idTarea);
            $validator = Validator::make($request->all(), [
                'fecha'=> 'required|string|max:255',
                'hora' => 'required|string',
                'TituloTarea'=> 'required|string|max:255',
                'DescripcionTarea' => 'required|string|max:255',
            ]);
            if ($validator->fails())
            {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', 'Hubo un error, favor de checar los campos');
                return redirect('/actualizarTarea/'.$tarea->idTarea);
            }
           
            $tarea->idDetalleCurso = $request->curso;
            $tarea->Fecha = $request->fecha;
            $tarea->Hora = $request->hora;
            $tarea->TituloTarea = $request->name;
            $tarea->DescripcionTarea = $request->descripcion;
            $tarea->updated_at = Carbon::now()->format('Y-m-d h:i:s');
            $tarea->save();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Tarea Creada Correctamente.');
            return redirect('/actualizarTarea/'.$tarea->idTarea);
        }
        else{
            return redirect('/home');
        }
    }
    //Funciones de alumnos
    public function inscribirCurso(Request $request){
        if(Auth::user()->idTipoUsuario == 5){
            $detalle = DetalleCurso::where('CodigoCurso','=',$request->Codigo)->first();
           
            if($detalle != null){
                $curso = Curso::where('idCurso','=', $detalle->idCurso)->first();
                $estudiante = Alumno::where('idUsuario','=', Auth::user()->id)->first();
                $escuela = Escuela::where('idEscuela','=', $estudiante->idEscuela)->first();
                if($escuela->idEscuela == $curso->idEscuela){
                    $inscripcion = Inscripcion::where('idAlumno','=',$estudiante->idAlumno)
                    ->where('idDetalleInscripcion','=',$detalle->idDetalleCurso)
                    ->first();
                    
                    if($inscripcion == null)
                    {
                        $inscripcion = new Inscripcion;
                        $inscripcion->idAlumno = $estudiante->idAlumno;
                        $inscripcion->idDetalleInscripcion = $detalle->idDetalleCurso;
                        $inscripcion->created_at = Carbon::now()->format('Y-m-d h:i:s');
                        $inscripcion->save();
                        Session::flash('alert-class', 'alert-success');
                        Session::flash('mensaje', 'Inscripción a Curso Realizada Correctamente.');
                        return redirect('/admiCursosEscuela');
                    }
                    else{
                        Session::flash('alert-class', 'alert-danger');
                        Session::flash('mensaje', 'Error Ud. Ya Inscribio este Curso.');
                        return redirect('/admiCursosEscuela');
                    }
                }
                else{
                    Session::flash('alert-class', 'alert-danger');
                    Session::flash('mensaje', 'Error Curso no Encontrado.');
                    return redirect('/admiCursosEscuela');
                }
            }
            else{
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', 'Error Curso no Encontrado.');
                return redirect('/admiCursosEscuela');
            }
        }
        else{
            return redirect('/home');
        }
    }
    public function admiCursosEscuela(){
        if(Auth::user()->idTipoUsuario == 5){
            $estudiante = Alumno::where('idUsuario','=', Auth::user()->id)->first();
            $escuela = Escuela::where('idEscuela','=', $estudiante->idEscuela)->first();
            $cursos = Curso::join('DetalleCurso','DetalleCurso.idCurso','=','Curso.idCurso')
            ->join('Profesor','Profesor.idProfesor','=','DetalleCurso.idProfesor')
            ->join('users','users.id','=','Profesor.idUsuario')
            ->where('Curso.idEscuela','=',$escuela->idEscuela)
            ->select('Curso.*','DetalleCurso.*','users.name as NombreProfesor')->get();
            
            return view('admiCursos')->with('estudiante',$estudiante)->with('escuela',$escuela)->with('cursos',$cursos);

        }
        else{
            return redirect('/home');
        }
    }
    public function misCursosInscritos(){
        if(Auth::user()->idTipoUsuario == 5){
            $estudiante = Alumno::where('idUsuario','=', Auth::user()->id)->first();
            $escuela = Escuela::where('idEscuela','=', $estudiante->idEscuela)->first();
            $cursos = Inscripcion::join('DetalleCurso','DetalleCurso.idDetalleCurso','=','Inscripcion.idDetalleInscripcion')
            ->join('Curso','Curso.idCurso','=','DetalleCurso.idCurso')
            ->join('Profesor','Profesor.idProfesor','=', 'DetalleCurso.idProfesor')
            ->join('users','users.id','=','Profesor.idUsuario')
            ->select('Curso.*','DetalleCurso.*','users.name as NombreProfesor')
            ->where('Inscripcion.idAlumno','=', $estudiante->idAlumno)
            ->get();
            return view('misCursos')->with('estudiante',$estudiante)->with('escuela',$escuela)->with('cursos',$cursos);
        }
        else{
            return redirect('/home');
        }
    }

}
