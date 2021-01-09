<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleTareaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DetalleTarea', function (Blueprint $table) {
            $table->bigIncrements('idDetalleTarea');
            $table->bigInteger('idTarea');
            $table->bigInteger('idAlumno');
            $table->string('Calificacion');
            $table->string('Comentarios');
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
        Schema::dropIfExists('DetalleTarea');
    }
}
