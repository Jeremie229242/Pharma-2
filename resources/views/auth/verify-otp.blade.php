



@extends("layouts.applog")
@section('title','PRO-PHARMA | LOGIN')
@section("contenu")

        <div class="container mx-auto px-4  h-full">
    <div class="flex content-center items-center justify-center h-full">

      <div class="w-full  px-4">
        <div
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200 border-0"
        >
          <div class="rounded-t mb-0 px-6 py-6">
            <div class="text-center mb-3">
              <h6 class="text-blueGray-500 text-sm font-bold">
                Sign in with
              </h6>
            </div>
            <div class="btn-wrapper text-center">
              <button
                class="bg-white active:bg-blueGray-50 text-blueGray-700 font-normal px-4 py-2 rounded outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs ease-linear transition-all duration-150"
                type="button"
              >
                <img alt="..." class="w-5 mr-1" :src="github" />
                Github
              </button>
              <button
                class="bg-white active:bg-blueGray-50 text-blueGray-700 font-normal px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs ease-linear transition-all duration-150"
                type="button"
              >
                <img alt="..." class="w-5 mr-1" :src="google" />
                Google
              </button>
            </div>
            <hr class="mt-6 border-b-1 border-blueGray-300" />
          </div>
          <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
            <div class="text-blueGray-400 text-center mb-3 font-bold">
              <small>Or sign in with credentials</small>
            </div>
            <form action="{{ route('otp.verify') }}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
              <div class="relative w-full mb-3">
                <label
                  class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                  htmlFor="grid-password"
                >
                Code reçu par email
                </label>
                <input
                  type="text"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Votre Email"
                  name="otp" maxlength="6"
                   required autofocus
                />
                @error('otp') <span class="text-red-600">{{ $message }}</span> @enderror
              </div>




              <div class="text-center mt-6">
                <button
                  class="bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
                  type="submit"
                >
                  Verifier
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="flex flex-wrap mt-6 relative">
          <!-- Bouton Renvoyer OTP -->
          <div class="w-1/2">
        <form method="POST" action="{{ route('otp.resend') }}" class="mt-4">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <button  class="bg-white text-black active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
            type="submit" >
                {{ __('Renvoyer le code OTP') }}
            </button>
        </form>
          </div>

          <!-- Bouton Renvoyer OTP -->
          <div class="w-1/2 text-right  mt-6 font-bold">
          <a href="{{ route('register') }}"  class="text-blueGray-200">
              <small>Créer â Nouveau Votre Compte</small>
            </a>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  @endsection












