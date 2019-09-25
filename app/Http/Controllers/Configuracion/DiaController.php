<?php

namespace App\Http\Controllers\Configuracion;

use App\Dia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class DiaController extends ApiController
{

    public function __construct()
    {
        parent::__construct(); //proteje las rutas.. 
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.configuracion.dia');
    }

    //devuelve lista de todos los registro
    public function index()
    {
        $dias = Dia::all();
        return $this->showAll($dias);
    }

    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string',
            'abreviatura' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $dia = dia::create($data);

        return $this->showOne($dia,201);
    }

    //devuelve registro por id
    public function show(Dia $dia)
    {
        return $this->showOne($dia);
    }

    //actualizar registro de la tabla
    public function update(Request $request, Dia $dia)
    {
        $reglas = [
            'nombre' => 'required|string',
            'abreviatura' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $dia->nombre = $request->nombre;
        $dia->abreviatura = $request->abreviatura;

         if (!$dia->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $dia->save();
        return $this->showOne($dia);
    }

    //eliminar un registro de la tabla
    public function destroy(Dia $dia)
    {
        $dia->delete();

        return $this->showOne($dia);
    }
}
