<?php

namespace App\Http\Controllers;

use DateTime;
use App\Empleado;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReporteController extends Controller
{
    public function empleados()
    {
        $empleados_informacion = array();
        $empleados = Empleado::with('municipio.departamento','telefonos','estado_civil')->get();

        foreach ($empleados as $key => $empleado) 
        {
            $data['correlativo'] = $key+1;
            $data['dpi'] = $empleado->dpi;
            $data['nit'] = $empleado->nit;
            $data['empleado'] = $empleado->nombre1;
            if(!is_null($empleado->nombre2))
                $data['empleado'] .= ' '.$empleado->nombre2;

            $data['empleado'] .= ' '.$empleado->apellido1;
            if(!is_null($empleado->apellido2))
                $data['empleado'] .= ' '.$empleado->apellido2;

            $data['nacimiento'] = date('d/m/Y', strtotime($empleado->nacimiento));
            $data['email'] = $empleado->email;

            if($empleado->genero == 'F')
                $data['genero'] = 'Femenino';
            else
                $data['genero'] = 'Masculino';

            $data['profesion'] = $empleado->profesion; 
            $data['direccion'] = $empleado->municipio->departamento->nombre.', '.$empleado->municipio->nombre.', '.$empleado->direccion; 
            $data['estado_civil'] = $empleado->estado_civil->nombre; 

            $data['telefonos'] = array();
            foreach ($empleado->telefonos as $key => $telefono) {  
                $data_tel['correlativo_tel'] = $key+1;
                $data_tel['numero'] = $telefono->telefono;
                array_push($data['telefonos'],$data_tel);
            }

            array_push($empleados_informacion,$data);
        }
        
        $usuario = Empleado::findOrFail(Auth::user()->empleado_id);
        $pdf = PDF::loadView('layout.reporte.empleado', compact('empleados_informacion','usuario'));

        Log::debug('Imprimio Empleados', array('información' => $empleados_informacion));
        return $pdf->stream('empleado.pdf');
    }

    public function historial($id)
    {
        $empleado = Empleado::with('municipio.departamento','telefonos','estado_civil')->where('id',$id)->first();

        $data['dpi'] = $empleado->dpi;
        $data['nit'] = $empleado->nit;
        $data['empleado'] = $empleado->nombre1;
        if(!is_null($empleado->nombre2))
            $data['empleado'] .= ' '.$empleado->nombre2;

        $data['empleado'] .= ' '.$empleado->apellido1;
        if(!is_null($empleado->apellido2))
            $data['empleado'] .= ' '.$empleado->apellido2;

        $data['nacimiento'] = date('d/m/Y', strtotime($empleado->nacimiento));
        $data['email'] = $empleado->email;

        if($empleado->genero == 'F')
            $data['genero'] = 'Femenino';
        else
            $data['genero'] = 'Masculino';

        $hoy = new DateTime();
        $fecha = new DateTime($empleado->nacimiento);
        $annos = $hoy->diff($fecha);
        $data['edad'] = $annos->y;
        $data['profesion'] = $empleado->profesion; 
        $data['direccion'] = $empleado->municipio->departamento->nombre.', '.$empleado->municipio->nombre.', '.$empleado->direccion; 
        $data['estado_civil'] = $empleado->estado_civil->nombre; 

        $data['telefonos'] = '';
        foreach ($empleado->telefonos as $key => $telefono) {  
            $data['telefonos'] .= $telefono->telefono.', ';
        }

        $usuario = Empleado::findOrFail(Auth::user()->empleado_id);
        $pdf = PDF::loadView('layout.reporte.historial', compact('data','usuario'));

        Log::debug('Imprimio Historial', array('información' => $data));
        return $pdf->stream('historial.pdf');
    }    
}
