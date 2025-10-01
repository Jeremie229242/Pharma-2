


@extends("layouts.appdash")
@section('title','PRO-PHARMA | LOGIN')
@section("content")






          <div class="relative bg-emerald-500 md:pt-32 pb-32 pt-12">





          </div>

        <section class="relative py-40 bg-blueGray-200">
        <div class="container mx-auto px-4">
          <div
            class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64"
          >
            <div class="px-6">

              <div class="flex flex-wrap justify-center">
                <div
                  class="w-full lg:w-3/12 px-8 lg:order-2 flex justify-center"
                >
                  <div class="relative">
                    <img
                      alt="..."
                      src="{{asset('v1/img/team-2-800x800.jpg')}}"
                      class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px"
                    />
                  </div>
                </div>
                <div
                  class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center"
                >
                  <div class="py-6 px-3 mt-32 sm:mt-0">



                  </div>
                </div>
                <div class="w-full lg:w-4/12 px-4 lg:order-1">

                </div>
              </div>
              <div class="text-center mt-12">
                <h3
                  class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2"
                >
                Détails de la ville
                </h3>
                <div
                  class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase"
                >
                  <i
                    class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400"
                  ></i>
                  {{ $ville->name_ville }}
                </div>
                <div class="mb-2 text-blueGray-600 mt-10">
                  <i class="fas fa-briefcase mr-2 text-lg text-blueGray-400"></i
                  >Date de création : {{ $ville->created_at->format('d/m/Y H:i') }}
                </div>
                <div class="mb-2 text-blueGray-600">
                  <i
                    class="fas fa-university mr-2 text-lg text-blueGray-400"
                  ></i
                  >Dernière modification :   {{ $ville->updated_at->format('d/m/Y H:i') }}
                </div>
              </div>
              <hr class="mt-6 border-b-1 border-blueGray-300" />


              <div class="rounded-t  mb-0 px-6 py-6">
                  <div class="text-center flex justify-between">
                    <a  href="{{ route('villes.index') }}" class="text-blueGray-700 px-2 py-2 rounded-lg shadow hover:shadow-md outline-none focus:outline-none  bg-pink-500 text-xl font-bold">
                     Retour
                    </a>
                    <a
                      class="bg-emerald-500 text-white font-bold uppercase text-xs px-4 py-2 rounded-lg shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
href="{{ route('villes.edit', $ville) }}"
                    >
                     Modifier
                    </a>

            </div>
          </div>
        </div>
      </section>



          </div>








         <x-footer></x-footer>
        </div>





          @endsection



      