<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            return back()->withErrors(['email' => 'Utilisateur introuvable']);
        }

        if ($user->otp === $request->otp && now()->lt($user->otp_expires_at)) {
            $user->is_verified = true;
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            // connecter automatiquement
            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Compte vérifié avec succès !');
        }

        return back()->withErrors(['otp' => 'Code invalide ou expiré.']);
    }



    public function resend(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    $user = User::where('email', $request->email)->first();

    // 🔒 Vérification délai avant renvoi d’un nouvel OTP (ex: 2 minutes)
    
    if ($user->otp_expires_at && $user->otp_expires_at->gt(now()->subMinutes(2))) {
        return back()->withErrors(['otp' => 'Veuillez patienter avant de demander un nouvel OTP.']);
    }

    if ($user->is_verified) {
        return redirect()->route('login')->with('info', 'Votre compte est déjà vérifié.');
    }

    // Générer un nouveau OTP
    $otp = rand(100000, 999999);
    $user->otp = $otp;
    $user->otp_expires_at = now()->addMinutes(10);
    $user->save();

    // Envoyer mail
    //Mail::to($user->email)->send(new \App\Mail\OtpMail($otp));
    Mail::to($user->email)->send(new OtpMail($otp));

    return back()->with('success', 'Un nouveau code OTP vous a été envoyé.');
}



    }



