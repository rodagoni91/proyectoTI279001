<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(seederTipoUsuario::class);
        $this->call(seederUsuario::class);
        $this->call(seederEscuela::class);
        $this->call(seederProfesor::class);
        $this->call(seederCurso::class);
    }
}
