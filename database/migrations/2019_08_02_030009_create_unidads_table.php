<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadsTable extends Migration
{
    public function up()
    {
        Schema::create('unidads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',100)->unique();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('unidads');
    }
}
