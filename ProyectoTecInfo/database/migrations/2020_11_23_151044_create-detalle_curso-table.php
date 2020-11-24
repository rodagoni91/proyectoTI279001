<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleCursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DetalleCurso', function (Blueprint $table) {
            $table->bigIncrements('idDetalleCurso');
            $table->bigInteger('idCurso');
            $table->bigInteger('idProfesor');
            $table->string('Hora');
            $table->string('CodigoCurso');
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
        Schema::dropIfExists('DetalleCurso');
    }
}
