<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Curso;
use App\Tarea;
use Illuminate\Support\Facades\Response;
use Validator;
use Carbon\Carbon;
class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coleccion = Tarea::join('Curso','Curso.idCurso','=','Tarea.idCurso')
        ->select('Tarea.*','Curso.NombreCurso')->get();
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
            'idCurso'=>'required|numeric',
            'FechaEntrega' => 'required|string',
            'DescripcionTarea' => 'required|string',
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

        $tarea = new Tarea;
        $tarea->idCurso = filter_var($request->idCurso,FILTER_SANITIZE_NUMBER_INT);
        $tarea->FechaEntrega = filter_var($request->FechaEntrega,FILTER_SANITIZE_STRING);
        $tarea->DescripcionTarea = filter_var($request->DescripcionTarea,FILTER_SANITIZE_STRING);
        $tarea->created_at = Carbon::now()->format('Y-m-d h:i:s');
        $tarea->save();
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
        $coleccion = Tarea::join('Curso','Curso.idCurso','=','Tarea.idCurso')
        ->select('Tarea.*','Curso.NombreCurso')->where('Tarea.idTarea','=',$id)->first();
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
        $tarea = Tarea::find($id);
        $validator = Validator::make($request->all(), [
            'idCurso'=>'required|numeric',
            'FechaEntrega' => 'required|string',
            'DescripcionTarea' => 'required|string',
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

        $tarea->idCurso = filter_var($request->idCurso,FILTER_SANITIZE_NUMBER_INT);
        $tarea->FechaEntrega = filter_var($request->FechaEntrega,FILTER_SANITIZE_STRING);
        $tarea->DescripcionTarea = filter_var($request->DescripcionTarea,FILTER_SANITIZE_STRING);
        $tarea->created_at = Carbon::now()->format('Y-m-d h:i:s');
        $tarea->save();
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
        $tarea = Tarea::find($id);
        $tarea->delete();
       

        $response = Response::json([
        'res' => true
        ], 201);

        return $response; 
    }
}
