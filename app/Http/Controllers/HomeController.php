<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\Empleado;
use App\User;
use Illuminate\Support\Facades\DB;
use Charts;
use App\Http\Controllers\ApiController;
use App\TipoContrato;
use App\Unidad;
use App\UnidadCargo;

class HomeController extends ApiController
{
	public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $contratos = Contrato::all();
        $contratos_activo = Contrato::where('vencido',true)->get();
        $contratos_inactivo = Contrato::where('vencido',false)->get();

        return view('home',compact('contratos','contratos_activo','contratos_inactivo'));
    }

    public function ordernaMeses()
    {
        $labels = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $contratos = array();

        for ($i=1; $i < 13; $i++) 
        { 
            $encontrados = Contrato::whereMonth('fecha_inicio',$i)->whereYear('fecha_inicio',date('Y'))->get();

            array_push($contratos,count($encontrados));
        }
        
        return response()->json(['grafica'=>$contratos,'label'=>$labels], 200);
    }

    public function contratoDepartamento()
    {
        $labels = array();
        $personal = array();

        $unidades_cargos = UnidadCargo::with('unidad','cargo')->get();
        
        foreach ($unidades_cargos as $unidad_cargo) 
        {
            $contratos = Contrato::where('unidad_cargo_id',$unidad_cargo->id)->where('vencido',false)->get();

            array_push($labels,$unidad_cargo->cargo->nombre.' '.$unidad_cargo->unidad->nombre);
            array_push($personal,count($contratos));
        }

        return response()->json(['grafica'=>$personal,'label'=>$labels], 200);
    }

    public function empleadosGraficar()
    {
        $labels = ['Inactivos','Activos'];

        $empleados = array();
        $empleado = Empleado::where('estado',false)->get();
        array_push($empleados,count($empleado));
        $empleado = Empleado::where('estado',true)->get();
        array_push($empleados,count($empleado));   
        
        return response()->json(['grafica'=>$empleados,'label'=>$labels], 200);
    }

    public function tipoContratos()
    {
        $labels = array();
        $tipos = array();

        $tipos_contratos = TipoContrato::all();

        foreach ($tipos_contratos as $tipo_contrato) 
        {
            $contratos = Contrato::where('tipo_contrato_id',$tipo_contrato->id)->where('vencido',false)->get();

            array_push($labels,$tipo_contrato->nombre.' / '.$tipo_contrato->numero);
            array_push($tipos,count($contratos));
        }

        return response()->json(['grafica'=>$tipos,'label'=>$labels], 200);
    }
}
