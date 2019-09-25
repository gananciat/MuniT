<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentoContratosTable extends Migration
{
    public function up()
    {
        Schema::create('documento_contratos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('doc',500);

            $table->unsignedBigInteger('contrato_id');
            $table->foreign('contrato_id')->references('id')->on('contratos')->onUpdate('cascade');

            $table->unsignedBigInteger('tipo_documento_id');
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documentos')->onUpdate('cascade');
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documento_contratos');
    }
}
