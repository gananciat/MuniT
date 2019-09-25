<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestacionTipoContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestacion_tipo_contratos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tipo_contrato_id');
            $table->foreign('tipo_contrato_id')->references('id')->on('tipo_contratos')->onUpdate('cascade');
            $table->unsignedBigInteger('prestacion_id');
            $table->foreign('prestacion_id')->references('id')->on('prestacions')->onUpdate('cascade');
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
        Schema::dropIfExists('prestacion_tipo_contratos');
    }
}
