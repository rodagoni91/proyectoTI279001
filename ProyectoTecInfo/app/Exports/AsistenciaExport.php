<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use DateTime;
use Auth;
use App\User;
use App\Escuela;
use App\Profesor;
use App\Curso;
use App\DetalleCurso;
use App\Alumno;
class ProductsExport implements FromCollection,WithHeadings, WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $profesor = Profesor::where('idUsuario','=',Auth::user()->id)->first();
        $escuela = Escuela::where('idEscuela','=',$profesor->idEscuela)->first();
        $curso = DetalleCurso::find($request->idDetalleCurso);
        $fecha =  date('Y-n-j');
        $asistencia = Asistencia::join('Alumno','Alumno.idAlumno','=','Asistencia.idAlumno')
        ->join('users','users.id','=','Alumno.idUsuario')
        ->select('users.name as NombreAlumno','Asistencia.Fecha as FechaAsistencia')
        ->where('Asistencia.FechaAsistencia','=',$fecha)
        ->get();
        return $asistencia;
    }

    public function headings(): array
    {
        return [
            'idAlumno',
            'Nombre Alumno',
            'Fecha Asistencia',
        ];
    }
}