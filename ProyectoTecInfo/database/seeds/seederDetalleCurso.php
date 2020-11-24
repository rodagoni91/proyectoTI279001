<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Profesor;
use App\Curso;
class seederDetalleCurso extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $cursos = Curso::all();
        $totalCursos = count($cursos) - 1;
        $profesores = Profesor::all();
        $totalProfesores = count($profesores) - 1;
        $horas = array('7:00','8:00','9:00','10:00','11:00','12:00','13:00','14:00');

        for($i = 0; $i < 1500; $i++){
        	DB::table('DetalleCurso')->insert([
                'idProfesor' => $profesores[rand(0,$totalProfesores)]->idProfesor,
                'idCurso' => $cursos[rand(0,$totalCursos)]->idCurso,
                'Hora' => $horas[rand(0,6)],
                'CodigoCurso' => rand(2500,7500),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
