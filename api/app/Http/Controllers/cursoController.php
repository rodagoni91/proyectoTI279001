<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\tiposUsuario;
use Validator;
use App\Curso;
use Illuminate\Support\Facades\Response;
class cursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coleccion = Curso::join('users','users.id','=','Curso.idProfesor')
        ->join('TipoUsuario','TipoUsuario.idTipoUsuario','=','users.idTipoUsuario')
        ->select('Curso.*','users.*','users.name as nombreProfesor','TipoUsuario.nombre as nombretipousuario')
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
            'idProfesor' => 'required|numeric',
            'NombreCurso' => 'required|string',
            'Hora' => 'required|string',
            'Dias' => 'required|string',
            'CodigoInscripcion' => 'required|string'
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

        $curso = new Curso;
        $curso->idProfesor = filter_var($request->idProfesor,FILTER_SANITIZE_NUMBER_INT);
        $curso->NombreCurso = filter_var($request->NombreCurso,FILTER_SANITIZE_STRING);
        $curso->Hora = filter_var($request->Hora,FILTER_SANITIZE_STRING);
        $curso->Dias = filter_var($request->Dias,FILTER_SANITIZE_STRING);
        $curso->CodigoInscripcion = filter_var($request->CodigoInscripcion,FILTER_SANITIZE_STRING);
        $curso->created_at = Carbon::now()->format('Y-m-d h:i:s');
        $curso->save();

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
        $coleccion = Curso::join('users','users.id','=','Curso.idProfesor')
        ->join('TipoUsuario','TipoUsuario.idTipoUsuario','=','users.idTipoUsuario')
        ->select('Curso.*','users.name as nombreProfesor','TipoUsuario.nombre as nombretipousuario')
        ->where('Curso.idCurso','=',$id)
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
        $curso = Curso::find($id);
        $validator = Validator::make($request->all(), [
            'idProfesor' => 'required|numeric',
            'NombreCurso' => 'required|string',
            'Hora' => 'required|string',
            'Dias' => 'required|string',
            'CodigoInscripcion' => 'required|string'
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

        
        $curso->idProfesor = filter_var($request->idProfesor,FILTER_SANITIZE_NUMBER_INT);
        $curso->NombreCurso = filter_var($request->NombreCurso,FILTER_SANITIZE_STRING);
        $curso->Hora = filter_var($request->Hora,FILTER_SANITIZE_STRING);
        $curso->Dias = filter_var($request->Dias,FILTER_SANITIZE_STRING);
        $curso->CodigoInscripcion = filter_var($request->CodigoInscripcion,FILTER_SANITIZE_STRING);
        $curso->created_at = Carbon::now()->format('Y-m-d h:i:s');
        $curso->save();

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
        $curso = Curso::find($id);
        $curso->delete();
       

        $response = Response::json([
        'res' => true
        ], 201);

        return $response; 
    }
}
