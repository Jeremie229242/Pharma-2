<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    { // ✅ Validation des champs
        $request->validate([ 'token' => ['required'],
         'email' => ['required', 'email'],
         'password' => ['required', 'confirmed',
         Rules\Password::defaults()], ]);
         
         try { // 🔄 Tentative de réinitialisation du mot de passe
            $status = Password::reset( $request->only('email', 'password', 'password_confirmation', 'token'),
             function ($user) use ($request) { $user->forceFill([ 'password' => Hash::make($request->password),
                 'remember_token' => Str::random(60), ])->save();
                 event(new PasswordReset($user)); } );
                 // ✅ Si succès
                 if ($status === Password::PASSWORD_RESET)
                 { Alert::success('Mot de passe réinitialisé', 'Votre mot de passe a été mis à jour avec succès. Vous pouvez maintenant vous connecter.');
                    return redirect()->route('login'); }
                    // ❌ Si échec (token invalide ou email incorrect)
                    Alert::error('Erreur', 'Impossible de réinitialiser le mot de passe. Vérifiez vos informations.');
                    return back()->withInput($request->only('email'));
                 } catch (\Throwable $e) {
                    // ⚠️ En cas d’erreur inattendue
                    Alert::error('Erreur système', 'Une erreur est survenue : ' . $e->getMessage());
                    return back();
                 }
        }
}
