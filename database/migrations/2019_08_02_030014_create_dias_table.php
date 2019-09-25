<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiasTable extends Migration
{
    public function up()
    {
        Schema::create('dias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',12)->unique();
            $table->string('abreviatura',4)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dias');
    }
}
