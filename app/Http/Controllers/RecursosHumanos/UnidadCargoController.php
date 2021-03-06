<?php

namespace App\Http\Controllers\RecursosHumanos;

use App\UnidadCargo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Log;

class UnidadCargoController extends ApiController
{
   public function __construct()
    {
        parent::__construct(); //proteje las rutas
        $this->middleware('consulta');
    }

    //lista todos los registros de la tabla
    public function index()
    {
        $unidadCargos = UnidadCargo::all();
        return $this->showAll($unidadCargos);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $reglas = [
            'cargo_id' => 'required',
            'unidad_id' => 'required'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $unidadCargo = UnidadCargo::create($data);
        if($unidadCargo)
            Log::info('INSERT '.$unidadCargo);

        return $this->showOne($unidadCargo,201);
    }

    //muestra un registro por id
    public function show(UnidadCargo $unidadCargo)
    {
        return $this->showOne($unidadCargo);
    }

    //actualiza el registro
    public function update(Request $request, UnidadCargo $unidadCargo)
    {
        $reglas = [
            'cargo_id' => 'required',
            'unidad_id' => 'unidad_id'
        ];

        $this->validate($request, $reglas);

        $unidadCargo->cargo_id = $request->cargo_id;
        $unidadCargo->unidad_id = $request->unidad_id;

        if (!$unidadCargo->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        if($unidadCargo->save())
            Log::notice('UPDATE '.$unidadCargo);

        return $this->showOne($unidadCargo);
    }

    //elminar registro de la tabla
    public function destroy(UnidadCargo $unidadCargo)
    {
        if($unidadCargo->delete())
            Log::critical('DELETE '.$unidadCargo);

        return $this->showOne($unidadCargo);
    }
}
