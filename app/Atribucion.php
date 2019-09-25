<?php

namespace App;

use App\Cargo;
use Illuminate\Database\Eloquent\Model;

class Atribucion extends Model
{
    protected $table = 'atribucions';
    protected $fillable= [
    	'descripcion',
    	'cargo_id'
    ];

    public function cargo()
    {
    	return $this->belongsTo(Cargo::class);
    }
}
