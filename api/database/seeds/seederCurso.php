<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\User;
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
        $usuarios = User::where('idTipoUsuario','=',4)->get();
        $total = count($usuarios);
        $horas = array('7:00am','8:00am','9:00am','13:00pm','14:00pm','19:00pm','20:00pm');
     	for($i = 0; $i < $total-1; $i++){
        	DB::table('Curso')->insert([
                'idProfesor'=> $usuarios[$i]->id,
                'NombreCurso' => $faker->name,
                'Hora' => $horas[rand(0,6)],
                'Dias' => "Lunes-Miercoles-Viernes",
                'CodigoInscripcion' => substr(md5(microtime()),rand(0,26),6),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
