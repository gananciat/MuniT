<?php

namespace App\Http\Controllers\Configuracion;

use App\Municipio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Log;

class MunicipioController extends ApiController
{
    public function __construct()
    {
        parent::__construct();//retornar registro por id
        $this->middleware('consulta');
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.configuracion.municipio');
    }

    //retorna todos los registros de la tabla
    public function index()
    {
        $municipios = Municipio::with('departamento')->get();
        return $this->showAll($municipios);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string',
            'departamento_id' =>'required|exists:departamentos,id'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $municipio = Municipio::create($data);

        if($municipio)
            Log::info('INSERT '.$municipio);

        return $this->showOne($municipio,201);
    }

    //mostrar registro por id
    public function show(Municipio $municipio)
    {
        return $this->showOne($municipio);
    }

    //actualizar registro
    public function update(Request $request, Municipio $municipio)
    {
        $reglas = [
            'nombre' => 'required|string',
            'departamento_id' =>'required|exists:departamentos,id'
        ];

        $this->validate($request, $reglas);

        $municipio->nombre = $request->nombre;
        $municipio->departamento_id = $request->departamento_id;

         if (!$municipio->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        if($municipio->save())
            Log::notice('UPDATE '.$municipio); 

        return $this->showOne($municipio);
    }

    //eliminar registro a nivel logico
    public function destroy(Municipio $municipio)
    {
        if($municipio->delete())
            Log::critical('DELETE '.$municipio); 

        return $this->showOne($municipio);
    }
}
