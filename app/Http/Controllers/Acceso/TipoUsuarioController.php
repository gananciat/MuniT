<?php

namespace App\Http\Controllers\Acceso;

use App\TipoUsuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class TipoUsuarioController extends ApiController
{
   public function __construct()
    {
        parent::__construct(); //proteje las rutas
    }

    //retorna vista principal
    public function view()
    {
       return view('layout.acceso.tipoUsuario');
    }

    //lista todos los registros de la tabla
    public function index()
    {
        $tipoUsuarios = TipoUsuario::all();
        return $this->showAll($tipoUsuarios);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $tipoUsuario = TipoUsuario::create($data);

        return $this->showOne($tipoUsuario,201);
    }

    //muestra un registro por id
    public function show(TipoUsuario $tipoUsuario)
    {
        return $this->showOne($tipoUsuario);
    }

    //actualiza el registro
    public function update(Request $request, tipoUsuario $tipoUsuario)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $tipoUsuario->nombre = $request->nombre;

         if (!$tipoUsuario->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $tipoUsuario->save();
        return $this->showOne($tipoUsuario);
    }

    //elminar registro de la tabla
    public function destroy(TipoUsuario $tipoUsuario)
    {
        $tipoUsuario->delete();

        return $this->showOne($tipoUsuario);
    }
}
