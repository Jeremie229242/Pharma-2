


@extends("layouts.appdash")
@section('title','PRO-PHARMA | Villes')
@section("content")







<div class="relative bg-emerald-500 md:pt-32 pb-32 pt-12">


</div>

<div class="px-4 md:px-10 mx-auto w-full -m-24">
          <div class="flex flex-wrap">
            <div class="w-full lg:w-12/12 px-4">
              <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
              >
              <div class="rounded-t  mb-0 px-6 py-6">
                  <div class="text-center flex justify-between">
                    <h6 class="text-blueGray-700 text-xl font-bold">
                      Formulaire de modification
                    </h6>

                  </div>
                </div>
                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                <form action="{{ route('pharmacies.update', $pharmacie->id) }}" method="POST">
        @csrf
        @method('PUT')
                    <h6
                      class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase"
                    >
                      Pharmacie Information
                    </h6>
                    <div class="flex flex-wrap">
                      <div class="w-full lg:w-6/12 px-4">
                        <div class="relative w-full mb-3">
                          <label
                            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                            htmlFor="grid-password"
                          >
                            Nom de la pharmacie
                          </label>
                          <input
                            type="text"
                            name="name_pharmacie"
                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"

                            value="{{ $pharmacie->name_pharmacie }}"
                            required
                          />
                        </div>
                      </div>
                      <div class="w-full lg:w-6/12 px-4">
                        <div class="relative w-full mb-3">
                          <label
                            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                            htmlFor="grid-password"
                          >
                            Nom de la Commune
                          </label>
                          <select
                          name="commune_id"
                          class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                          required

    >

      @foreach($communes as $commune)
                    <option value="{{ $commune->id }}" {{ $pharmacie->commune_id == $commune->id ? 'selected' : '' }}>
                        {{ $commune->name_commune }}
                    </option>
                @endforeach
    </select>
                        </div>
                      </div>


                      <div class="w-full lg:w-6/12 px-4">
                        <div class="relative w-full mb-3">
                          <label
                            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                            htmlFor="grid-password"
                          >
                            Addresse de la pharmacie
                          </label>
                          <input
                            type="text"
                            name="adresse"
                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"

                            value="{{ $pharmacie->adresse }}"
                            required
                          />
                        </div>
                      </div>
                      <div class="w-full lg:w-6/12 px-4">
                        <div class="relative w-full mb-3">
                          <label
                            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                            htmlFor="grid-password"
                          >
                            Nom de la Commune
                          </label>
                          <input
                            type="number"
                            name="telephone"
                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"

                            value="{{ $pharmacie->telephone }}"
                            required
                          />
                        </div>
                      </div>


                    </div>

                    <hr class="mt-6 border-b-1 border-blueGray-300" />



                    <div class="rounded-t  mb-0 px-6 py-6">
                  <div class="text-center flex justify-between">
                    <a  href="{{ route('communes.index') }}" class="text-blueGray-700 px-2 py-2 rounded-lg  bg-pink-500 text-xl font-bold">
                     Retour
                    </a>
                    <button
                      class="bg-emerald-500 text-white font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                      type="submit"
                    >
                      Mettre a Jour
                    </button>
                  </div>
                </div>


                  </form>
                </div>
              </div>
            </div>

          </div>

        </div>

@endsection


