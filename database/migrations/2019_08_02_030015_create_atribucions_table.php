<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtribucionsTable extends Migration
{
    public function up()
    {
        Schema::create('atribucions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion',150);

            $table->unsignedBigInteger('cargo_id');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onUpdate('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('atribucions');
    }
}
