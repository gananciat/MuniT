<?php

namespace App;

use App\Departamento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipio extends Model
{
    use SoftDeletes;

    protected $table = 'municipios';
    protected $fillable= [
    	'nombre',
    	'departamento_id'
    ];

    public function departamento()
    {
    	return $this->belongsTo(Departamento::class);
    }
}
