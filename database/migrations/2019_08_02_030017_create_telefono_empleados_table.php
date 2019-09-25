<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefonoEmpleadosTable extends Migration
{
    public function up()
    {
        Schema::create('telefono_empleados', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->string('telefono',8);

            $table->unsignedBigInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onUpdate('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('telefono_empleados');
    }
}
