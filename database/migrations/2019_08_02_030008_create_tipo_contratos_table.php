<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoContratosTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_contratos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',75);
            $table->string('numero',4);
            $table->string('descripcion',500)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_contratos');
    }
}
