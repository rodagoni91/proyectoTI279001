<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\tipoUsuario;
use App\User;
use App\Escuela;
class seederProfesor extends Seeder
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
        $escuelas = Escuela::all();
        $totalEscuelas = count($escuelas) - 1;

     	for($i = 0; $i < $total-1; $i++){
        	DB::table('Profesor')->insert([
                'idUsuario'=> $usuarios[$i]->id,
                'idEscuela' => $escuelas[rand(0,$totalEscuelas)]->idEscuela,
                'Direccion' => $faker->address                             ,
                'Telefono' => $faker->tollFreePhoneNumber,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
