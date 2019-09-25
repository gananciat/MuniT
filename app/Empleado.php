<?php

namespace App;

use App\User;
use App\Contrato;
use App\Municipio;
use App\EstadoCivil;
use App\TelefonoEmpleado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use SoftDeletes;

    protected $table = 'empleados';
    protected $fillable= [
    	'dpi',
    	'nit',
    	'nombre1',
    	'nombre2',
    	'apellido1',
    	'apellido2',
    	'nacimiento',
    	'direccion',
    	'email',
    	'estado_civil_id',
    	'municipio_id',
    	'avatar',
    	'estado',
        'genero',
        'profesion'
    ];

    public function estado_civil()
    {
    	return $this->belongsTo(EstadoCivil::class);
    }

    public function municipio()
    {
    	return $this->belongsTo(Municipio::class,'municipio_id');
    }

    public function telefonos()
    {
        return $this->hasMany(TelefonoEmpleado::class);
    }

    public function usuario()
    {
        return $this->hasOne(User::class);
    }

    public function contratos()
    {
        return $this->hasMany(Contrato::class)->orderBy('id','desc')->withTrashed();
    }

    public function contratos_trashed()
    {
        return $this->hasMany(Contrato::class)->withTrashed();
    }
}
