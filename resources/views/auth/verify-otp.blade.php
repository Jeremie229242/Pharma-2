@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Vérification OTP</h3>
    <form action="{{ route('otp.verify') }}" method="POST">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <div class="mb-3">
            <label for="otp">Entrez le code reçu par email</label>
            <input type="text" name="otp" class="form-control" maxlength="6" required>
        </div>
        <button type="submit" class="btn btn-primary">Vérifier</button>
    </form>

     <!-- Bouton Renvoyer OTP -->
     <form method="POST" action="{{ route('otp.resend') }}" class="mt-4">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <x-secondary-button>
            {{ __('Renvoyer le code OTP') }}
        </x-secondary-button>
    </form>
</div>
@endsection
