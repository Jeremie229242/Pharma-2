<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckVilecom
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
        $userVilleId = Auth::user()->ville_id;

        // Vérifie si une commune est passée dans la route
        if ($request->route('commune')) {
            $commune = $request->route('commune');
            if ($commune->ville_id !== $userVilleId) {
                abort(403, 'Accès refusé : cette commune n’appartient pas à votre ville.');
            }
        }

        // Vérifie si une ville est passée dans la route
        if ($request->route('ville')) {
            $villeId = $request->route('ville');
            if ($userVilleId != $villeId) {
                abort(403, 'Accès refusé : vous n’avez pas accès à cette ville.');
            }
        }

        return $next($request);
    }
}
