<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration
{
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_contrato',15)->unique();
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->decimal('salario',11,2);
            $table->decimal('primer_salario',11,2)->default(0);
            $table->decimal('monto',11,2)->default(0);
            $table->integer('cantidad_pagos')->default(0);
            $table->boolean('vencido')->default(0);
            $table->date('fecha_terminado')->nullable();
            
            $table->unsignedBigInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onUpdate('cascade');

            $table->unsignedBigInteger('tipo_contrato_id');
            $table->foreign('tipo_contrato_id')->references('id')->on('tipo_contratos')->onUpdate('cascade');

            $table->unsignedBigInteger('unidad_cargo_id');
            $table->foreign('unidad_cargo_id')->references('id')->on('unidad_cargos')->onUpdate('cascade');

            $table->softDeletes();
            $table->timestamps();

            
        });
    }

    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
