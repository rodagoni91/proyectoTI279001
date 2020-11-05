<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\tiposUsuario;
use Validator;
use Illuminate\Support\Facades\Response;
class UsuarioController extends Controller
{
    public function index()
    {
        //Index me regresa todo lo de la coleccion
        
       $coleccion = User::join('TipoUsuario','TipoUsuario.idTipoUsuario','=','users.idTipoUsuario')
        ->select('users.*','TipoUsuario.nombre as nombretipousuario')
        ->get();
        $response = Response::json($coleccion,200);
        return $response;
    }


    public function store(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'idTipoUsuario' => 'required|integer',
            'name'=>'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
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


        $response = Response::json([
            'res' => true
        ], 201);

        return $response;
    }

     public function show($id)
    {
        //muestra 1 solo registro de la bd
        $usuario = User::join('TipoUsuario','TipoUsuario.idTipoUsuario','=','users.idTipoUsuario')
        ->select('users.*','TipoUsuario.nombre as nombretipousuario')
        ->find($id);

       //$usuario = User::find($id);

        $response = Response::json($usuario,200);

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
        //muestra 1 solo registro y puede ser modificado, 
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
        //actualiza la informacion de la bd
        //recibe informacion y lo almacena en la bd
        //dd($request);
        $usuario = User::find($id);
        $validator = Validator::make($request->all(), [
            
            'name'=>'required|string',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
            
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

        
     
        $usuario->name = filter_var($request->name, FILTER_SANITIZE_STRING);
        $usuario->email = filter_var($request->email,FILTER_SANITIZE_EMAIL);
        $usuario->password = filter_var(bcrypt($request->password), FILTER_SANITIZE_STRING);
        $usuario->save();


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
        $usuario = User::find($id);
        $usuario->delete();

        $response = Response::json([
            'res' => true
        ], 201);

        return $response; 
    }

}
