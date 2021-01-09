<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\tipoUsuario;
use App\User; 
class seederEscuela extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $usuarios = User::where('idTipoUsuario','=',3)->get();
        $total = count($usuarios);
     	for($i = 0; $i < $total-1; $i++){
        	DB::table('Escuela')->insert([
                'idUsuario'=> $usuarios[$i]->id,
                'Direccion' => $faker->address,
                'Telefono' => $faker->tollFreePhoneNumber,
                'Director' => 'Ing. '.$faker->name,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
