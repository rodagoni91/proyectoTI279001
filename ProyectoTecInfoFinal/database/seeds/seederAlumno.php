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
        $idAlumno = 0;

     	for($i = 0; $i < $totalEscuelas-1; $i++){
        	DB::table('Alumno')->insert([
                'idUsuario'=> $usuarios[$idAlumno]->id,
                'idEscuela' => $escuelas[$i]->idEscuela,
                'Direccion' => $faker->address,
                'Telefono' => $faker->tollFreePhoneNumber,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);   
            $idAlumno++;      
        }

        for($i = 0; $i < $totalEscuelas-1; $i++){
        	DB::table('Alumno')->insert([
                'idUsuario'=> $usuarios[$idAlumno]->id,
                'idEscuela' => $escuelas[$i]->idEscuela,
                'Direccion' => $faker->address,
                'Telefono' => $faker->tollFreePhoneNumber,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);   
            $idAlumno++;      
        }

        for($i = 0; $i < $totalEscuelas-1; $i++){
        	DB::table('Alumno')->insert([
                'idUsuario'=> $usuarios[$idAlumno]->id,
                'idEscuela' => $escuelas[$i]->idEscuela,
                'Direccion' => $faker->address,
                'Telefono' => $faker->tollFreePhoneNumber,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);   
            $idAlumno++;      
        }
    }
}
