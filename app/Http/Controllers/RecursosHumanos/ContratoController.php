<?php

namespace App\Http\Controllers\RecursosHumanos;

use App\Contrato;
use App\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ContratoController extends ApiController
{
    public function __construct()
    {
        parent::__construct(); //proteje las rutas
        $this->middleware('consulta', ['only' => ['store','show','update','destroy']]);
    }

    //retorna vista principal
    public function view()
    {
       return view('layout.rrh.contrato');
    }

    //lista todos los registros de la tabla
    public function index()
    {
        $contratos = Contrato::all();

        $current_date = Carbon::now()->format('d/m/Y');

        foreach ($contratos as $contrato) {
            if(Carbon::parse($contrato->fecha_fin)->format('d/m/Y') < $current_date){
                $contrato->vencido = true;
                if($contrato->save())
                    Log::notice('UPDATE '.$contrato);

                $empleado = $contrato->empleado;
                $empleado->estado = false;
                if($empleado->save())
                    Log::notice('UPDATE '.$empleado);
            }
        }

        $contratos = Contrato::with('empleado','tipo_contrato','unidad_cargo')->get();

        return $this->showAll($contratos);
    }

    //lista todos los registros de la tabla
    public function getDocs($id)
    {
        $contrato = Contrato::find($id);
        $documentos = $contrato->documentos()->with('tipo_documento')->get();
        return $this->showAll($documentos);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $reglas = [
            'fecha_inicio'=> 'required',
            'salario' => 'required',
            'monto' => 'required',
            'empleado_id' => 'required|integer|exists:empleados,id',
            'tipo_contrato_id' => 'required|integer|exists:tipo_contratos,id',
            'unidad_cargo_id' => 'required|integer|exists:unidad_cargos,id'
        ];
        
        $this->validate($request, $reglas);

        DB::beginTransaction();
            $data = $request->all();
            $empleado = Empleado::findOrFail($request->empleado_id);

            $empleado->estado = true;
            if($empleado->save())
            {
                Log::notice('UPDATE '.$empleado);
                $contrato = Contrato::create($data);
                if($contrato)
                    Log::info('INSERT '.$contrato);                
            }

        DB::commit();

        return $this->showOne($contrato,201);
    }

    //muestra un registro por id
    public function show(Contrato $contrato)
    {
        return $this->showOne($contrato);
    }

    //actualiza el registro terminar contrato
    public function update(Request $request, Contrato $contrato)
    {
        DB::beginTransaction();
        $contrato->anulado=true;
        $contrato->fecha_anulado = $request->fecha_anulado;

        $empleado = $contrato->empleado;
        $empleado->estado = false;
        $empleado->save();

        if($contrato->save())
                Log::notice('UPDATE '.$contrato);
        DB::commit();
        return $this->showOne($contrato,201);
    }

    //elminar registro de la tabla
    public function destroy(Contrato $contrato)
    {
        DB::beginTransaction();
            $empleado = $contrato->empleado;
            $empleado->estado = false;
            if($empleado->save())
                Log::notice('UPDATE '.$empleado);

            if($contrato->delete())
                Log::critical('DELETE '.$contrato);
                
        DB::commit();

        return $this->showOne($contrato);
    }
}
