<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\OtpMail;

class OtpController extends Controller
{

    public function showForm(Request $request)
    {
        $email = session('email');
        return view('auth.verify-otp', compact('email'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {

            Alert::error('Erreur otp', 'Utilisateur introuvable. Veuillez vous Réinscrire');
            return redirect()->back();
        }


         // Si OTP expiré et jamais vérifié
    if (!$user->is_verified && $user->otp_expires_at && now()->gt($user->otp_expires_at)) {
        $user->delete(); // supprime l’utilisateur de la base

            Alert::warning('Erreur otp', 'Votre code OTP a expiré. Cliquer sur Renvoyer code Otp Pour recevoir un nouveau code.');
            return redirect()->back();

    }


        if ($user->otp === $request->otp && now()->lt($user->otp_expires_at)) {
            $user->is_verified = true;
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            // connecter automatiquement
            Auth::login($user);

            Alert::success('Vérification Réussie', 'Compte vérifié avec succès.');

            return redirect()->route('apres.ville', ['ville' => $user->ville_id]);
          // return view('ville', $user->ville_id)->with('success', 'Compte vérifié avec succès !');

        }

        Alert::error('Erreur otp', 'Votre code OTP a expiré. Cliquer sur Renvoyer code Otp Pour recevoir un nouveau code.');
            return redirect()->back();
    }



    public function resend(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    $user = User::where('email', $request->email)->first();

    // 🔒 Vérification délai avant renvoi d’un nouvel OTP (ex: 2 minutes)



    if ($user->otp_sent_at && $user->otp_sent_at->gt(now()->subMinutes(2))) {
        Alert::warning('Erreur otp', 'Veuillez patienter 3 minutes avant de demander un nouvel OTP.');
        return redirect()->back();
    }

    if ($user->is_verified) {
        return redirect()->route('login')->with('info', 'Votre compte est déjà vérifié.');
    }

    // Générer un nouveau OTP
    $otp = rand(100000, 999999);
    $user->otp = $otp;
    $user->otp_expires_at = now()->addMinutes(10);
    $user->otp_sent_at = now();
    $user->save();

    // Envoyer mail

    Mail::to($user->email)->send(new OtpMail($otp));

    return back()->with('success', 'Un nouveau code OTP vous a été envoyé.');
}



    }



