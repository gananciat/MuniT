<?php

namespace App\Http\Controllers\Acceso;

use App\User;
use App\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
   public function __construct()
    {
        parent::__construct();//retornar registro por id
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.acceso.user');
    }

    //retorna todos los registros de la tabla
    public function index()
    {
        $users = User::with('empleado','tipo_usuario')->get();
        return $this->showAll($users);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $usuario = User::where('empleado_id',$request->empleado_id)->first();

        if($usuario !== null) return $this->errorResponse('empleado ya tiene usuario creado', 422);

        $reglas = [
            'password' => 'required', 'string', 'min:6', 'confirmed',
            'tipo_usuario_id' =>'required|exists:tipo_usuarios,id',
            'empleado_id' =>'required|exists:empleados,id'
        ];

        $empleado = Empleado::find($request->empleado_id);
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['email'] = $empleado->email;

        $user = User::create($data);

        return $this->showOne($user,201);
    }

    //mostrar registro por id
    public function show(User $user)
    {
        return $this->showOne($user);
    }

    //actualizar registro
    public function update(Request $request, User $user)
    {
        $reglas = [
            'tipo_usuario_id' =>'required|exists:tipo_usuarios,id'
        ];

        $this->validate($request, $reglas);

        $user->tipo_usuario_id = $request->tipo_usuario_id;

         if (!$user->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $user->save();
        return $this->showOne($user);
    }

    //eliminar registro a nivel logico
    public function destroy(User $user)
    {
        $user->delete();

        return $this->showOne($user);
    }

    //funcion para cambiar contraseña
    public function changePassword(Request $request)
    {
        $user = User::find($request->id);

        $reglas = [
            'password' => 'required', 'string', 'min:6', 'confirmed',
        ];
        
        $this->validate($request, $reglas);

        if (Hash::check($request->password, $user->password)) {
            return $this->errorResponse('la contraseña actual no puede ser igual a la nueva contraseña',422);
        }

        if (Hash::check($request->old_password, $user->password)) { 
            $user->password = bcrypt($request->password);
            $user->save();
        } else {
            return $this->errorResponse('la contraseña anterior es incorrecta',422);
        }


        return $this->showOne($user,'201','update');
    }
}
