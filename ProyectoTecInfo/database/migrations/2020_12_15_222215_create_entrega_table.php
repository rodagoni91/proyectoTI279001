<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntregaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Entregas', function (Blueprint $table) {
            $table->bigIncrements('idEntrega');
            $table->bigInteger('idTarea');
            $table->bigInteger('idAlumno');
            $table->string('ArchivoTarea');
            $table->string('Calificacion');
            $table->string('Observaciones');
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
        Schema::dropIfExists('Entregas');
    }
}
