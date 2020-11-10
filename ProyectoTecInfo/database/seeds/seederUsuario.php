<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\tipoUsuario;
class seederUsuario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $tipos = tipoUsuario::all();


        DB::table('users')->insert([
            'idTipoUsuario'=> 1,
            'name' => 'Rogelio Daniel',
            'phone' => '4442355318',
            'email' => 'rodagono@gmail.com',
            'password'=>bcrypt('password'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'idTipoUsuario'=> 1,
            'name' => 'Superusuario',
            'phone' => '5552221100',
            'email' => 'superusuario@correo.com',
            'password'=>bcrypt('password'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'idTipoUsuario'=> 2,
            'name' => 'Administrador',
            'phone' => '5552221100',
            'email' => 'administrador@correo.com',
            'password'=>bcrypt('password'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        for($i = 0; $i < 150; $i++){
        	DB::table('users')->insert([
                'idTipoUsuario'=> $tipos[rand(0,4)]->idTipoUsuario,
                'name' => $faker->name,
                'phone' => $faker->tollFreePhoneNumber,
                'email' => $faker->email,
                'password'=>bcrypt('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
