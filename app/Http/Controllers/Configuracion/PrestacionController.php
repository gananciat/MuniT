<?php

namespace App\Http\Controllers\Configuracion;

use App\Prestacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class PrestacionController extends ApiController
{
     public function __construct()
    {
        parent::__construct(); //proteje las rutas
    }

    //retorna vista principal
    public function view()
    {
       return view('layout.configuracion.prestacion');
    }

    //lista todos los registros de la tabla
    public function index()
    {
        $prestacions = Prestacion::all();
        return $this->showAll($prestacions);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $prestacion = prestacion::create($data);

        return $this->showOne($prestacion,201);
    }

    //muestra un registro por id
    public function show(Prestacion $prestacion)
    {
        return $this->showOne($prestacion);
    }

    //actualiza el registro
    public function update(Request $request, prestacion $prestacion)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $prestacion->nombre = $request->nombre;

         if (!$prestacion->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $prestacion->save();
        return $this->showOne($prestacion);
    }

    //elminar registro de la tabla
    public function destroy(Prestacion $prestacion)
    {
        $prestacion->delete();

        return $this->showOne($prestacion);
    }
}
