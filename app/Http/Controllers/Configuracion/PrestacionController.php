<?php

namespace App\Http\Controllers\Configuracion;

use App\Prestacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Log;

class PrestacionController extends ApiController
{
     public function __construct()
    {
        parent::__construct(); //proteje las rutas
        $this->middleware('consulta');
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

        if($prestacion)
            Log::info('INSERT '.$prestacion);

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

        if($prestacion->save())
            Log::notice('UPDATE '.$prestacion); 

        return $this->showOne($prestacion);
    }

    //elminar registro de la tabla
    public function destroy(Prestacion $prestacion)
    {
        if($prestacion->delete())
            Log::critical('DELETE '.$prestacion); 

        return $this->showOne($prestacion);
    }
}
