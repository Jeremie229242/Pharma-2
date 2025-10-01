<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Gate::allows("admin")) {
            return $next($request);
        }

        // Bloquer avec une erreur 403 directement
        abort(403, 'Accès refusé : vous n’avez pas accès à cette ressource.');
    }

}
