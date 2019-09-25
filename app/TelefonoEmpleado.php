<?php

namespace App;

use App\Empleado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelefonoEmpleado extends Model
{
    use SoftDeletes;

    protected $table = 'telefono_empleados';
    protected $fillable= [
    	'empleado_id',
    	'telefono'
    ];

    public function empleado()
    {
    	return $this->belonsgTo(Empleado::class);
    }
}
