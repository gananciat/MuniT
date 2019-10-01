<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Consulta
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->tipo_usuario_id == 2)
            return redirect()->route('home')->withStatus(__('NO tiene autorización para esta acción.'));
        else
            return $next($request);
    }
}
