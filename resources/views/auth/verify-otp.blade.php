<x-guest-layout>
    <div class="container max-w-md mx-auto mt-10">
        <h3 class="text-xl font-bold mb-4">Vérification OTP</h3>

        <!-- Formulaire Vérification -->
        <form action="{{ route('otp.verify') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <div>
                <label for="otp" class="block text-sm font-medium">Code reçu par email</label>
                <input type="text" name="otp" class="form-control w-full" maxlength="6" required>
                @error('otp') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <x-primary-button class="btn btn-primary w-full">Vérifier</x-primary-button>
        </form>

        <!-- Bouton Renvoyer OTP -->
        <form method="POST" action="{{ route('otp.resend') }}" class="mt-4">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <x-primary-button class="w-full">
                {{ __('Renvoyer le code OTP') }}
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>
