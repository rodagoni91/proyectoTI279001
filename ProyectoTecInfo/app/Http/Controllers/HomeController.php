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
        return view('home');
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
        else{
            return redirect('/home');
        }  
    }

    public function actualizarEscuela(Request $request){
        if(Auth::user()->idTipoUsuario == 1 || Auth::user()->idTipoUsuario == 2){
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
            $profesor->save();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Profesor Agregado Correctamente.');
            return redirect('/admiProfesores'); 
        }
        else{
            return redirect('/home');
        }   
    }

    public function eliminarProfesor(Request $request){
        if(Auth::user()->idTipoUsuario == 3){
            $profesor = Profesor::find($request->idProfesor);
            $usuario = User::find($profesor->idUsuario);
            $usuario->delete();
            $profesor->delete();
            $usuario->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('mensaje', 'Profesor Eliminado Correctamente.');
            return redirect('/admiProfesores');   
        }
        else{
            return redirect('/home');
        }   
    }

    public function vistaActualizarProfesor($idProfesor){
        if(Auth::user()->idTipoUsuario == 3){
            $profesor = Profesor::join('users','users.id','=','Profesor.idUsuario')
            ->select('Profesor.*','users.*')
            ->where('Profesor.idProfesor','=',$idProfesor)
            ->first();
            return view('actualizarProfesor')->with('profesor',$profesor);
        }
        else{
            return redirect('/home');
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

}
