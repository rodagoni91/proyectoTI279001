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
        for($i = 0; $i < 150; $i++){
        	DB::table('Curso')->insert([
                'idEscuela' => $escuelas[rand(0,$totalEscuelas)]->idEscuela,
                'idProfesor' => $profesores[rand(0,$totalProfesores)]->idProfesor,
                'NombreCurso' => $faker->word,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
