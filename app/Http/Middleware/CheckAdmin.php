<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class CheckAdmin
{

    public function handle(Request $request, Closure $next){
        if(Auth::user()->role == 'Administrador'){
            return $next($request);
        }
        return redirect()->back()->with('error', 'No tienes permiso para acceder a esta ruta');
    }
}
