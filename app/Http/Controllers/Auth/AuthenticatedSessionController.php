<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;
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
    try {
        // 🔐 Authentifier l'utilisateur
        $request->authenticate();

        $user = Auth::user();

        // 🔒 Vérifier que l'utilisateur a validé son OTP
        if (! $user->is_verified) {
            Auth::logout();
            Alert::warning('Compte non vérifié', 'Veuillez entrer le code OTP envoyé par email.');
            return redirect()->back();
        }

        // 🚀 Supprimer toutes les anciennes sessions (session unique)
        DB::table('sessions')->where('user_id', $user->id)->delete();

        // 🔔 Notifier si l'utilisateur était connecté ailleurs
        event(new SessionReplaced($user->id));

        // 🌀 Régénérer la session pour la nouvelle connexion
        $request->session()->regenerate();

        // ✅ Succès : redirection selon la ville de l'utilisateur
        Alert::success('Connexion réussie', 'Nous sommes content de vous revoir !');

        return redirect()->intended(RouteServiceProvider::redirectTo($user));
    } catch (\Throwable $e) {
        // ❌ En cas d'échec
        Alert::error('Erreur de connexion', 'Une erreur est survenue : ' . $e->getMessage());
        return redirect()->back();
    }
}



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Alert::success('Déconnexion réussie', 'Merci de votre Passage !');

        DB::table('sessions')->where('user_id', Auth::id())->delete();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        Alert::success('Déconnexion réussie', 'Merci de votre Passage !');
        return redirect()->route('login');
    }
}
