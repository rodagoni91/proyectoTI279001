<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Curso;
class seederTarea extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cursos = Curso::all();
        $total = count($cursos) - 1;
        $faker = Faker::create();
        for($i = 0; $i < 50; $i++){
        	DB::table('Tarea')->insert([
                'idCurso'=> $cursos[rand(0,$total)]->idCurso,
                'FechaEntrega' => $faker->creditCardExpirationDateString,
                'DescripcionTarea' => $faker->text,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
