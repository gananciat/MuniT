<?php

namespace App;

use App\Unidad;
use App\Atribucion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargo extends Model
{
    use SoftDeletes;

    protected $table = 'cargos';
    protected $fillable= [
    	'nombre'
    ];

    public function atribuciones(){
    	return $this->hasMany(Atribucion::class);
    }

    public function unidades(){
    	return $this->belongsToMany(Unidad::class,'unidad_cargos');
    }
}
