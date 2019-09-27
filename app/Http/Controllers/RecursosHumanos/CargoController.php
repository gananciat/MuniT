<?php

namespace App\Http\Controllers\RecursosHumanos;

use App\Cargo;
use App\Atribucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Log;

class CargoController extends ApiController
{
    public function __construct()
    {
        parent::__construct(); //proteje las rutas
        $this->middleware('consulta');
    }

    //retorna vista principal
    public function view()
    {
       return view('layout.rrh.cargo');
    }

    //lista todos los registros de la tabla
    public function index()
    {
        $cargos = Cargo::with('atribuciones')->get();
        return $this->showAll($cargos);
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
            $cargo = cargo::create($data);

            foreach ($request->atribuciones as $value) {
                $atribucion = new Atribucion();
                $atribucion->cargo_id = $cargo->id;
                $atribucion->descripcion = $value['descripcion'];

                if($atribucion)
                    Log::info('INSERT '.$atribucion);
            }

        DB::commit();

        return $this->showOne($cargo,201);
    }

    //muestra un registro por id
    public function show(Cargo $cargo)
    {
        return $this->showOne($cargo);
    }

    //actualiza el registro
    public function update(Request $request, Cargo $cargo)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $cargo->nombre = $request->nombre;

        $cargo->atribuciones()->delete(); //eliminamos los anteriores

        foreach ($request->atribuciones as $value) {
                $atribucion = new Atribucion();
                $atribucion->cargo_id = $cargo->id;
                $atribucion->descripcion = $value['descripcion'];

                if($atribucion->save())
                    Log::notice('UPDATE '.$atribucion); 
            }

        /* if (!$cargo->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }*/

        $cargo->save();
        return $this->showOne($cargo);
    }

    //elminar registro de la tabla
    public function destroy(Cargo $cargo)
    {
        if($cargo->delete())
            Log::critical('DELETE '.$cargo);

        return $this->showOne($cargo);
    }
}
