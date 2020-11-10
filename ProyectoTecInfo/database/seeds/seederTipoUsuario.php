<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
class seederTipoUsuario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        //1
        DB::table('TipoUsuario')->insert([
            'nombre'=> 'Superusuario',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //2
        DB::table('TipoUsuario')->insert([
            'nombre'=> 'Administrador',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //3
        DB::table('TipoUsuario')->insert([
            'nombre'=> 'Escuela',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
            //4
        DB::table('TipoUsuario')->insert([
            'nombre'=> 'Profesor',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
            //5
        DB::table('TipoUsuario')->insert([
            'nombre'=> 'Alumno',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    
    }
}
