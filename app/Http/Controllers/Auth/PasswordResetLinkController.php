<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        try { // 🔄 Envoi du lien de réinitialisation
            $status = Password::sendResetLink( $request->only('email') );
            if ($status === Password::RESET_LINK_SENT)
            { // ✅ Succès : afficher une alerte SweetAlert
                Alert::success('Succès', 'Un lien de réinitialisation a été envoyé à votre adresse email.');
                return back();
            } else {
                // ❌ Erreur d’envoi
                Alert::error('Erreur', 'Impossible d’envoyer le lien de réinitialisation. Vérifiez votre adresse email.');
                return back()->withInput($request->only('email'));
            } } catch (\Throwable $e) {
                // ⚠️ Erreur inattendue
                Alert::error('Erreur système', 'Une erreur est survenue : ' . $e->getMessage());
                return back();
             }

    }
}
