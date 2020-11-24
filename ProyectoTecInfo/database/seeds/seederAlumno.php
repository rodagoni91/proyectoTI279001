<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\tipoUsuario;
use App\User;
use App\Escuela;
class seederAlumno extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $usuarios = User::where('idTipoUsuario','=',5)->get();
        $total = count($usuarios);
        $escuelas = Escuela::all();
        $totalEscuelas = count($escuelas) - 1;
        $idEscuela = 1;
        $iCount = 0;
     	for($i = 0; $i < $total-1; $i++){
        	DB::table('Alumno')->insert([
                'idUsuario'=> $usuarios[$i]->id,
                'idEscuela' => $escuelas[idEscuela]->idEscuela,
                'Direccion' => $faker->address,
                'Telefono' => $faker->tollFreePhoneNumber,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            if($iCount == 20){
                $idEscuela++;
                $iCount = 0;
            }
            else{
                $iCount++;
            }
        }
    }
}
