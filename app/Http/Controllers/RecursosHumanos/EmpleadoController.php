<?php

namespace App\Http\Controllers\RecursosHumanos;

use App\Empleado;
use Carbon\Carbon;
use App\TelefonoEmpleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends ApiController
{
   public function __construct()
    {
        parent::__construct(); //proteje las rutas
    }

    //retorna vista principal
    public function view()
    {
       return view('layout.rrh.empleado');
    }

    //retorna vista con perfil de usuario
    public function viewPerfil()
    {
       return view('layout.acceso.perfil');
    }

    //lista todos los registros de la tabla
    public function index()
    {
        $empleados = Empleado::with('municipio.departamento','telefonos','estado_civil')->get();
        return $this->showAll($empleados);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $imagePath = '';
        if (preg_match('/^data:image\/(\w+);base64,/', $request->image_file)) {
            $data = substr($request->image_file, strpos($request->image_file, ',') + 1);
            $data = base64_decode($data);
            $imagePath = $request->nombre1.'_'.time().'.png';;
            Storage::disk('images')->put($imagePath, $data);
        }

        $reglas = [
            'nombre1' => 'required|string',
            'apellido1' => 'required|string',
            'email' => 'required|string',
            'municipio_id' => 'required|integer',
            'dpi' => 'required',
            'nit' => 'required',
        ];
        
        $this->validate($request, $reglas);

        DB::beginTransaction();
            $data = $request->all();
            $data['avatar'] = $imagePath;
            $empleado = Empleado::create($data);

            foreach ($request->telefonos as  $tel) {
                $telefono = new TelefonoEmpleado();
                $telefono->empleado_id = $empleado->id;
                $telefono->telefono = $tel['telefono'];

                $telefono->save();
            }
        DB::commit();

        return $this->showOne($empleado,201);
    }

    //muestra un registro por id
    public function show(Empleado $empleado)
    {
        $empleado_info = Empleado::where('id',$empleado->id)->with('usuario.tipo_usuario','contratos.unidad_cargo.cargo','contratos.unidad_cargo.unidad','contratos.tipo_contrato','telefonos','municipio.departamento','estado_civil')->firstOrFail();

        return $this->showOne($empleado_info);
    }

    //actualiza el registro
    public function update(Request $request, Empleado $empleado)
    {
        $reglas = [
            'nombre1' => 'required|string',
            'apellido1' => 'required|string',
            'email' => 'required|string',
            'municipio_id' => 'required|integer',
            'dpi' => 'required',
            'nit' => 'required',
        ];

        $this->validate($request, $reglas);

        DB::beginTransaction();

            $empleado->dpi = $request->dpi;
            $empleado->nit = $request->nit;
            $empleado->nombre1 = $request->nombre1;
            $empleado->nombre2 = $request->nombre2;
            $empleado->apellido1 = $request->apellido1;
            $empleado->apellido2 = $request->apellido2;
            $empleado->email = $request->email;
            $empleado->municipio_id = $request->municipio_id;
            $empleado->estado_civil_id = $request->estado_civil_id;
            $empleado->nacimiento = $request->nacimiento;
            $empleado->profesion = $request->profesion;

            if($request->image_file != null || $request->image_file != ''){
                $imagePath = '';
                if (preg_match('/^data:image\/(\w+);base64,/', $request->image_file)) {
                    $data = substr($request->image_file, strpos($request->image_file, ',') + 1);
                    $data = base64_decode($data);
                    $imagePath = $request->nombre1.'_'.time().'.png';;
                    Storage::disk('images')->put($imagePath, $data);
                }
                $empleado->avatar = $imagePath;
            }

            $empleado->telefonos()->delete(); //eliminamos los anteriores

            foreach ($request->telefonos as  $tel) {
                $telefono = new TelefonoEmpleado();
                $telefono->empleado_id = $empleado->id;
                $telefono->telefono = $tel['telefono'];

                $telefono->save();
            }

            $empleado->save();
        DB::commit();
        return $this->showOne($empleado);
    }

    //elminar registro de la tabla
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return $this->showOne($empleado);
    }

    public function cambiarEstado($id, Request $request){
        $empleado = Empleado::find($id);
        $empleado->estado = $request->estado;
        $empleado->save();
        return $this->showOne($empleado,201);
    }
}
