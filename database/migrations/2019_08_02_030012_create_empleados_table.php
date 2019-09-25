<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dpi',13)->unique();
            $table->string('nit',15)->unique();
            $table->string('avatar')->nullable();
            $table->string('nombre1',25);
            $table->string('nombre2')->nullable();
            $table->string('apellido1',25);
            $table->string('apellido2')->nullable();
            $table->date('nacimiento');
            $table->string('direccion',150);
            $table->string('email',150)->unique();
            $table->char('genero',1);
            $table->string('profesion',500);
            $table->unsignedBigInteger('estado_civil_id');
            $table->foreign('estado_civil_id')->references('id')->on('estado_civils')->onUpdate('cascade');

            $table->unsignedBigInteger('municipio_id');
            $table->foreign('municipio_id')->references('id')->on('municipios')->onUpdate('cascade');

            $table->boolean('estado')->default(1);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
