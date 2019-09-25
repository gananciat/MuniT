<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoContrato extends Model
{
    use SoftDeletes;

    protected $table = 'tipo_contratos';
    protected $fillable= [
    	'nombre',
    	'numero',
    	'descripcion'
    ];

    public function prestaciones(){
    	return $this->belongsToMany(Prestacion::class,'prestacion_tipo_contratos')
    				->withPivot('prestacion_id');
    }
}
