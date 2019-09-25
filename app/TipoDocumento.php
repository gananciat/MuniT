<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoDocumento extends Model
{
    use SoftDeletes;

    protected $table = 'tipo_documentos';
    protected $fillable= [
    	'nombre'
    ];
}
