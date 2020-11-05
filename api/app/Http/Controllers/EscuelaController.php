<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\tiposUsuario;
use Validator;
use Illuminate\Support\Facades\Response;
use App\Escuela;
class EscuelaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coleccion = Escuela::join('users','users.id','=','Escuela.idUsuario')
        ->join('TipoUsuario','TipoUsuario.idTipoUsuario','=','users.idTipoUsuario')
        ->select('Escuela.*','users.*','users.name as nombreEscuela','TipoUsuario.nombre as nombretipousuario')
        ->get();
        $response = Response::json($coleccion,200);
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
            'Direccion' => 'required|string|max:255',
            'Telefono' => 'required|string|max:255',
            'Director' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $var = array();
            $errors = $validator->errors()->toArray();

            foreach ($errors as $key => $value) {
                array_push($var, $value);
            }

            $response = Response::json([
                'res' => false,
                'errors' => $var
            ], 200);

            return $response;
        } 

        $usuario = new User;
        $usuario->idTipoUsuario = filter_var($request->idTipoUsuario,FILTER_SANITIZE_NUMBER_INT);
        $usuario->name = filter_var($request->name, FILTER_SANITIZE_STRING);
        $usuario->email = filter_var($request->email,FILTER_SANITIZE_EMAIL);
        $usuario->password = filter_var(bcrypt($request->password), FILTER_SANITIZE_STRING);
        $usuario->created_at = Carbon::now()->format('Y-m-d h:i:s');
        $usuario->save();

        $escuela = new Escuela;
        $escuela->idUsuario = $usuario->id;
        $escuela->Direccion = filter_var($request->Direccion,FILTER_SANITIZE_STRING);
        $escuela->Telefono = filter_var($request->Telefono,FILTER_SANITIZE_STRING);
        $escuela->Director = filter_var($request->Director,FILTER_SANITIZE_STRING);
        $escuela->created_at = Carbon::now()->format('Y-m-d h:i:s');
        $escuela->save();

        $response = Response::json([
            'res' => true
        ], 201);

        return $response;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coleccion = Escuela::join('users','users.id','=','Escuela.idUsuario')
        ->join('TipoUsuario','TipoUsuario.idTipoUsuario','=','users.idTipoUsuario')
        ->select('Escuela.*','users.*','users.name as nombreEscuela','TipoUsuario.nombre as nombretipousuario')
        ->where('Escuela.idEscuela','=',$id)
        ->first();
        $response = Response::json($coleccion,200);
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $escuela = Escuela::find($id);
        $usuario = User::find($escuela->idUsuario);

        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'password' => 'required|string',
            'Direccion' => 'required|string|max:255',
            'Telefono' => 'required|string|max:255',
            'Director' => 'required|string|max:255',
        ]);

         if ($validator->fails()) {
            $var = array();
            $errors = $validator->errors()->toArray();

            foreach ($errors as $key => $value) {
                array_push($var, $value);
            }

            $response = Response::json([
                'res' => false,
                'errors' => $var
            ], 200);

            return $response;
        } 

        //$usuario = new User;
        $usuario->idTipoUsuario = filter_var($request->idTipoUsuario,FILTER_SANITIZE_NUMBER_INT);
        $usuario->email = filter_var($request->email,FILTER_SANITIZE_EMAIL);
        $usuario->password = filter_var(bcrypt($request->password), FILTER_SANITIZE_STRING);
        $usuario->updated_at = Carbon::now()->format('Y-m-d h:i:s');
        $usuario->save();

        //$escuela = new Escuela;
        $escuela->idUsuario = $usuario->id;
        $escuela->Direccion = filter_var($request->Direccion,FILTER_SANITIZE_STRING);
        $escuela->Telefono = filter_var($request->Telefono,FILTER_SANITIZE_STRING);
        $escuela->Director = filter_var($request->Director,FILTER_SANITIZE_STRING);
        $escuela->updated_at = Carbon::now()->format('Y-m-d h:i:s');
        $escuela->save();

        $response = Response::json([
            'res' => true
        ], 201);

        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $escuela = Escuela::find($id);
        $usuario = User::find($escuela->idUsuario);
        $usuario->delete();
        $escuela->delete();

          $response = Response::json([
            'res' => true
        ], 201);

        return $response; 
    }
}
