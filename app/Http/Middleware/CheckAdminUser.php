<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        // Verifica se o usuário logado é um administrador
        if (!$request->user()->master) {
            return redirect()->route('dashboard.home')->with('error', 'Você não tem permissão para acessar a página.');
        }

        return $next($request);
    }
}
