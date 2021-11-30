<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserActive
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o usuário está ativo, se não estiver redireciona para login.
        if (! $request->user()->active) {

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors(['Sua conta não está ativa. Por favor, entre em contato com o administrador!']);
        }

        // Se o usuário estiver ativo, prossegue com a requisição.
        return $next($request);
    }
}
