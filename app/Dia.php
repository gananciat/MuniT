<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dia extends Model
{
    //use SoftDeletes;

    protected $table = 'dias';
    protected $fillable= [
    	'nombre',
    	'abreviatura'
    ];
}
