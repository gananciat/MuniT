<?php

namespace App\Http\Controllers\Configuracion;

use App\EstadoCivil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class EstadoCivilController extends ApiController
{
   public function __construct()
    {
        parent::__construct(); //protege el controlador
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.configuracion.estadoCivil');
    }

    //retorna lista de todos los registros de la tabla
    public function index()
    {
        $estadoCivils = EstadoCivil::all();
        return $this->showAll($estadoCivils);
    }

    //guardar registro en la tabla
    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $estadoCivil = estadoCivil::create($data);

        return $this->showOne($estadoCivil,201);
    }

    //mostrar registro por id
    public function show(EstadoCivil $estadoCivil)
    {
        return $this->showOne($estadoCivil);
    }

    //actualizar registro
    public function update(Request $request, EstadoCivil $estadoCivil)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $estadoCivil->nombre = $request->nombre;

         if (!$estadoCivil->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $estadoCivil->save();
        return $this->showOne($estadoCivil);
    }

    //eliminar registro de la tabla
    public function destroy(EstadoCivil $estadoCivil)
    {
        $estadoCivil->delete();

        return $this->showOne($estadoCivil);
    }
}
