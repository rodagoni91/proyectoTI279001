<?php
use Illuminate\Database\Seeder;
use App\User;
use App\Tarea;
use Faker\Factory as Faker;
use Carbon\Carbon;
class seederDetalleTarea extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $tareas = Tarea::all();
        $alumnos = User::where('idTipoUsuario','=',5)->get();
        $total = count($alumnos);
        $totalTareas = count($tareas) - 1;
        for($i = 0; $i < $total-1; $i++){
        	DB::table('DetalleTarea')->insert([
                'idAlumno' => $alumnos[$i]->id,
                'idTarea' => $tareas[rand(0,$totalTareas)]->idTarea,
                //'Calificacion' => rand(2,10),
                'FechaEntregada' => $faker->creditCardExpirationDateString,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
