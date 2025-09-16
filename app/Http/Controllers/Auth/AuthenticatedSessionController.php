<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

use App\Events\SessionReplaced;
use App\Models\User;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */

    public function store(LoginRequest $request): RedirectResponse
    {
        // Authentifier l'utilisateur
        $request->authenticate();

        $user = Auth::user();

        // 🔐 Vérifier que l'utilisateur a validé OTP
        if (! $user->is_verified) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Votre compte n’est pas encore vérifié. Veuillez entrer le code OTP envoyé par email.',
            ]);
        }

        // 🚀 Supprimer toutes les anciennes sessions (session unique)
        DB::table('sessions')->where('user_id', $user->id)->delete();

        // 🔔 Notifier en temps réel si l'utilisateur était connecté ailleurs
        event(new SessionReplaced($user->id));

        // Régénérer session pour la nouvelle connexion
        $request->session()->regenerate();

        // 🔹 Redirection selon la ville de l'utilisateur
        return redirect()->route('dashboard', $user->ville_id);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        DB::table('sessions')->where('user_id', Auth::id())->delete();
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
