<?php

namespace App;

use App\Municipio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamento extends Model
{
    use SoftDeletes;

    protected $table = 'departamentos';
    protected $fillable= [
    	'nombre'
    ];

    public function municipios(){
    	return $this->hasMany(Municipio::class);
    }
}
