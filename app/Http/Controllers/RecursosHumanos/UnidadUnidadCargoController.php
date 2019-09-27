<?php

namespace App\Http\Controllers\RecursosHumanos;

use App\Unidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Log;

class UnidadUnidadCargoController extends ApiController
{
   public function __construct()
    {
        parent::__construct(); //proteje las rutas
        $this->middleware('consulta');
    }

    //lista todos los registros de la tabla
    public function index(Unidad $unidad)
    {
        $cargos = $unidad->cargos;
        return $this->showAll($cargos);
    }
}
