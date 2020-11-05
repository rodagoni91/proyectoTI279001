<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscuelaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Escuela', function (Blueprint $table) {
            $table->bigIncrements('idEscuela');
            $table->bigInteger('idUsuario');
            $table->string('Direccion');
            $table->string('Telefono');
            $table->string('Director');
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
        Schema::dropIfExists('Escuela');
    }
}
