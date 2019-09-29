<?php

namespace App\Http\Controllers\Configuracion;

use App\TipoContrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Log;

class TipoContratoController extends ApiController
{
    public function __construct()
    {
        parent::__construct(); //proteje las rutas
        $this->middleware('consulta');
    }

    //retorna vista principal
    public function view()
    {
       return view('layout.configuracion.tipoContrato');
    }

    //lista todos los registros de la tabla
    public function index()
    {
        $tipoContratos = TipoContrato::with('prestaciones')->get();
        return $this->showAll($tipoContratos);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string',
            'numero' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        DB::beginTransaction();

            $data = $request->all();
            $tipoContrato = TipoContrato::create($data);

            if($tipoContrato)
                Log::info('INSERT '.$tipoContrato);

            $tipoContrato->prestaciones()->attach($request->prestaciones);

        DB::commit();

        return $this->showOne($tipoContrato,201);
    }

    //muestra un registro por id
    public function show(TipoContrato $tipoContrato)
    {
        return $this->showOne($tipoContrato);
    }

    //actualiza el registro
    public function update(Request $request, TipoContrato $tipoContrato)
    {
        $reglas = [
            'nombre' => 'required|string',
            'numero' => 'required|string'
        ];

        $this->validate($request, $reglas);

        DB::beginTransaction();
            $tipoContrato->nombre = $request->nombre;
            $tipoContrato->numero = $request->numero;
            $tipoContrato->descripcion = $request->descripcion;
            $tipoContrato->tiempo_indefinido = $request->tiempo_indefinido;

            //eliminamos registros anteriores
            $tipoContrato->prestaciones()->detach();
           
            //los volvemos agregar los registros
            $tipoContrato->prestaciones()->attach($request->prestaciones);

            /*if (!$tipoContrato->isDirty()) {
                return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
            }*/

            if($tipoContrato->save())
                Log::notice('UPDATE '.$tipoContrato); 

        DB::commit();
        return $this->showOne($tipoContrato);
    }

    //elminar registro de la tabla
    public function destroy(TipoContrato $tipoContrato)
    {
        if($tipoContrato->delete())
            Log::critical('DELETE '.$tipoContrato); 

        return $this->showOne($tipoContrato);
    }
}
