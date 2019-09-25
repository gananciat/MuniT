<?php

namespace App;

use App\Cargo;
use App\Unidad;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnidadCargo extends Model
{
    protected $table = 'unidad_cargos';
    protected $fillable= [
    	'cargo_id',
    	'unidad_id',
    	'created_at',
        'updated_at'
    ];

    public function cargo(){
    	return $this->belongsTo(Cargo::class);
    }

    public function unidad(){
    	return $this->belongsTo(Unidad::class);
    }
}
