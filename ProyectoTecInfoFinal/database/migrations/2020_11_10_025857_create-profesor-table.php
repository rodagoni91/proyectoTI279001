<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfesorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Profesor', function (Blueprint $table) {
            $table->bigIncrements('idProfesor');
            $table->bigInteger('idUsuario');
            $table->bigInteger('idEscuela');
            $table->string('Direccion');
            $table->string('Telefono');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Profesor'); 
    }
}
