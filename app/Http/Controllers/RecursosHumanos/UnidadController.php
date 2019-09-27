<?php

namespace App\Http\Controllers\RecursosHumanos;

use App\Unidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Log;

class UnidadController extends ApiController
{
     public function __construct()
    {
        parent::__construct(); //proteje las rutas
        $this->middleware('consulta');
    }

    //retorna vista principal
    public function view()
    {
       return view('layout.rrh.unidad');
    }

    //lista todos los registros de la tabla
    public function index()
    {
        $unidads = Unidad::with('cargos')->get();
        return $this->showAll($unidads);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        DB::beginTransaction();
            $data = $request->all();
            $unidad = unidad::create($data);
            if($unidad)
                Log::info('INSERT '.$unidad);

            $unidad->cargos()->attach($request->cargos);

        DB::commit();

        return $this->showOne($unidad,201);
    }

    //muestra un registro por id
    public function show(Unidad $unidad)
    {
        return $this->showOne($unidad);
    }

    //actualiza el registro
    public function update(Request $request, Unidad $unidad)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $unidad->nombre = $request->nombre;

         if (!$unidad->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        if($unidad->save())
            Log::notice('UPDATE '.$unidad);

        return $this->showOne($unidad);
    }

    //elminar registro de la tabla
    public function destroy(Unidad $unidad)
    {
        if($unidad->delete())
            Log::critical('DELETE '.$unidad);

        return $this->showOne($unidad);
    }
}
