<?php

namespace App;

use App\TipoContrato;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestacion extends Model
{
    use SoftDeletes;

    protected $table = 'prestacions';
    protected $fillable= [
    	'nombre'
    ];

    public function tipo_contrato(){
    	return $this->belongsToMany(TipoContrato::class,'prestacion_tipo_contratos')
    				->withPivot('tipo_contrato_id');
    }
}
