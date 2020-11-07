<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Tarea;
use Validator;
use App\DetalleTarea;
use Illuminate\Support\Facades\Response;
class DetalleTareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coleccion = DetalleTarea::join('Tarea','Tarea.idTarea','=','DetalleTarea.idTarea')
        ->join('users','users.id','=','DetalleTarea.idAlumno')
        ->join('Curso','Curso.idCurso','=','Tarea.idCurso')
        ->select('DetalleTarea.*','Curso.NombreCurso','users.name as NombreAlumno')
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
            'idAlumno'=>'required|numeric',
            'idTarea'=>'required|numeric',
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


        $detalle = new DetalleTarea;
        $detalle->idAlumno =  filter_var($request->idAlumno,FILTER_SANITIZE_NUMBER_INT);
        $detalle->idTarea =  filter_var($request->idTarea,FILTER_SANITIZE_NUMBER_INT);
        $detalle->FechaEntregada = Carbon::now()->format('Y-m-d h:i:s');
        $detalle->created_at = Carbon::now()->format('Y-m-d h:i:s');
        $detalle->save();

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
        $coleccion = DetalleTarea::join('Tarea','Tarea.idTarea','=','DetalleTarea.idTarea')
        ->join('users','users.id','=','DetalleTarea.idAlumno')
        ->join('Curso','Curso.idCurso','=','Tarea.idCurso')
        ->select('DetalleTarea.*','Curso.NombreCurso','users.name as NombreAlumno')
        ->where('DetalleTarea.idDetalleTarea','=', $id)
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
        $detalle = DetalleTarea::find($id);

        $validator = Validator::make($request->all(), [
            'idAlumno'=>'required|numeric',
            'idTarea'=>'required|numeric',
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

        $detalle->idAlumno =  filter_var($request->idAlumno,FILTER_SANITIZE_NUMBER_INT);
        $detalle->idTarea =  filter_var($request->idTarea,FILTER_SANITIZE_NUMBER_INT);
        $detalle->FechaEntregada = Carbon::now()->format('Y-m-d h:i:s');
        $detalle->created_at = Carbon::now()->format('Y-m-d h:i:s');
        $detalle->save();

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
        $tarea = DetalleTarea::find($id);
        $tarea->delete();
    
        $response = Response::json([
        'res' => true
        ], 201);

        return $response; 
    }
}
