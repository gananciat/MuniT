<?php

namespace App\Http\Controllers\Configuracion;

use App\Departamento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class DepartamentoController extends ApiController
{
    public function __construct()
    {
        parent::__construct(); //proteje las rutas
    }

    //retorna vista principal
    public function view()
    {
       return view('layout.configuracion.departamento');
    }

    //lista todos los registros de la tabla
    public function index()
    {
        $departamentos = Departamento::with('municipios')->get();
        return $this->showAll($departamentos);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $departamento = Departamento::create($data);

        return $this->showOne($departamento,201);
    }

    //muestra un registro por id
    public function show(Departamento $departamento)
    {
        return $this->showOne($departamento);
    }

    //actualiza el registro
    public function update(Request $request, Departamento $departamento)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $departamento->nombre = $request->nombre;

         if (!$departamento->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $departamento->save();
        return $this->showOne($departamento);
    }

    //elminar registro de la tabla
    public function destroy(Departamento $departamento)
    {
        $departamento->delete();

        return $this->showOne($departamento);
    }
}
