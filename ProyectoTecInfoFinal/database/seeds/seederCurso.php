<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Profesor;
use App\Escuela;
class seederCurso extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $escuelas = Escuela::all();
        $totalEscuelas = count($escuelas) - 1;
        $profesores = Profesor::all();
        $totalProfesores = count($profesores) - 1;

        $dias = array('Diaria','Terciada');
        $horas = array('7:00','8:00','9:00','10:00','11:00','12:00','13:00');

        $idEscuela = 0;
        $iContador = 0;

        for($i = 0; $i < $totalEscuelas - 1; $i++){
        	DB::table('Curso')->insert([
                'idEscuela' => $escuelas[$i]->idEscuela,
                'NombreCurso' => $faker->word,
                'Dias' => $dias[rand(0,1)],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

        }

        for($i = 0; $i < $totalEscuelas - 1; $i++){
        	DB::table('Curso')->insert([
                'idEscuela' => $escuelas[$i]->idEscuela,
                'NombreCurso' => $faker->word,
                'Dias' => $dias[rand(0,1)],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

        }

        for($i = 0; $i < $totalEscuelas - 1; $i++){
        	DB::table('Curso')->insert([
                'idEscuela' => $escuelas[$i]->idEscuela,
                'NombreCurso' => $faker->word,
                'Dias' => $dias[rand(0,1)],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

        }



    }
}
