<?php

namespace App;

use App\Empleado;
use App\UnidadCargo;
use App\TipoContrato;
use App\DocumentoContrato;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrato extends Model
{
    use SoftDeletes;

    protected $table = 'contratos';
    protected $fillable= [
        'no_contrato',
    	'fecha_inicio',
    	'fecha_fin',
    	'primer_salario',
    	'salario',
    	'monto',
    	'cantidad_pagos',
    	'empleado_id',
    	'tipo_contrato_id',
    	'unidad_cargo_id',
    	'vencido',
        'termiando'
    ];

    public function empleado()
    {
    	return $this->belongsTo(Empleado::class);
    }

    public function tipo_contrato()
    {
    	return $this->belongsTo(TipoContrato::class);
    }

    public function unidad_cargo()
    {
    	return $this->belongsTo(UnidadCargo::class);
    }

    public function documentos(){
        return $this->hasMany(DocumentoContrato::class);
    }
}
