<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tareas', function (Blueprint $table) {
            $table->bigIncrements('idTarea');
            $table->bigInteger('idDetalleCurso');
            $table->string('Fecha');
            $table->string('Hora');
            $table->string('TituloTarea');
            $table->string('DescripcionTarea');
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
        Schema::dropIfExists('Tareas');
    }
}
