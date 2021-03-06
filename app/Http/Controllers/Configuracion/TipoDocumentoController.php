<?php

namespace App\Http\Controllers\Configuracion;

use App\TipoDocumento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Log;

class TipoDocumentoController extends ApiController
{
    public function __construct()
    {
        parent::__construct();//proteger controlador
        $this->middleware('consulta');
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.configuracion.tipoDocumento');
    }

    //retorna todos los registros de la tabla
    public function index()
    {
        $tipoDocumentos = TipoDocumento::all();
        return $this->showAll($tipoDocumentos);
    }

    //guarda registro en la tabla
    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $tipoDocumento = tipoDocumento::create($data);

        if($tipoDocumento)
            Log::info('INSERT '.$tipoDocumento);

        return $this->showOne($tipoDocumento,201);
    }

    //obtiene registro por id
    public function show(TipoDocumento $tipoDocumento)
    {
        return $this->showOne($tipoDocumento);
    }

    //actualizar registro
    public function update(Request $request, TipoDocumento $tipoDocumento)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $tipoDocumento->nombre = $request->nombre;

         if (!$tipoDocumento->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        if($tipoDocumento->save())
            Log::notice('UPDATE '.$tipoDocumento); 

        return $this->showOne($tipoDocumento);
    }

    //eliminar registro de la tabla a nivel logico
    public function destroy(TipoDocumento $tipoDocumento)
    {
        if($tipoDocumento->delete())
            Log::critical('DELETE '.$tipoDocumento);

        return $this->showOne($tipoDocumento);
    }
}
