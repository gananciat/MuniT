<?php

namespace App;

use App\Cargo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidad extends Model
{
    use SoftDeletes;

    protected $table = 'unidads';
    protected $fillable= [
    	'nombre'
    ];

    public function cargos(){
    	return $this->belongsToMany(Cargo::class,'unidad_cargos')->withPivot('id')->withTimestamps();
    }
}
