

@extends("layouts.appdash")
@section('title','PRO-PHARMA | Villes')
@section("content")



<div class="relative bg-emerald-500 md:pt-32 pb-32 pt-12">


</div>

<div class="px-4 md:px-10 mx-auto w-full -m-24">

    <!-- Card stats -->
    <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">
              <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white"
              >
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                  <div class="flex flex-wrap items-center">
                    <div
                      class="relative w-full px-4 max-w-full flex-grow flex-1"
                    >
                      <h3 class="font-semibold text-lg text-blueGray-700">
                      Liste des programmes de garde
                      </h3>
                    </div>
                    <div
                  class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center"
                >
                  <div class="py-6 px-3 mt-32 sm:mt-0">
                    <a href="{{ route('programmes.create') }}"
                      class="bg-emerald-500 active:bg-emerald-900 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150"

                    >
                    <i class="fas fa-plus mr-1 "></i> Ajouter
                    </a>
                  </div>
                </div>
                  </div>

                </div>
                @if($programmes->isEmpty())
        <div class="alert alert-info">Aucun programme enregistré.</div>
    @else
                <div class="block w-full overflow-x-auto">
                  <!-- Projects table -->
                  <table
                    class="items-center w-full bg-transparent border-collapse"
                  >
                    <thead>
                      <tr>
                        <th
                          class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                        >
                          Ville
                        </th>
                        <th
                          class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                        >
                           commune
                        </th>
                        <th
                          class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                        >
                          Pharmacie
                        </th>

                        <th
                          class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                        >
                          Date Debut
                        </th>
                        <th
                          class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                        >
                           Date fin
                        </th>
                        <th
                          class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                        >
                          De garde
                        </th>

                        <th
                          class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                        ></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($programmes as $programme)
                      <tr>
                        <th
                          class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center"
                        >

                          <span class="ml-3 font-bold text-blueGray-600">
                          {{ $programme->commune->ville->name_ville }}
                          </span>
                        </th>
                        <td
                          class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                          <div class="flex">
                          {{ $programme->commune->name_commune }}
                          </div>
                        </td>
                        <td
                          class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                        <ul>
                                @foreach($programme->pharmacies as $pharmacie)
                                    <li>{{ $pharmacie->name_pharmacie }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td
                          class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                          <div class="flex">
                          {{ $programme->date_debut }}
                          </div>
                        </td>
                        <td
                          class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                          <div class="flex">
                          {{ $programme->date_fin }}
                          </div>
                        </td>
                        <td
                          class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                          <div class="flex">
                          @if($programme->is_garde)
                                ✅ Oui
                            @else
                                ❌ Non
                            @endif
                          </div>
                        </td>

                        <td
                          class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-right"
                        >
                          <a
                            href="#J"
                            class="text-blueGray-500 block py-1 px-3"
                            onclick="openDropdown(event,'table-light-{{ $programme->id }}-dropdown')"
                          >
                            <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div
                            class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                            id="table-light-{{ $programme->id }}-dropdown"
                          >
                            <a
                              href="{{ route('programmes.show', $programme->id) }}"
                              class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                              >Voir</a
                            ><a
                              href="{{ route('programmes.edit', $programme->id) }}"
                              class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                              >Modifier</a
                            >


                            <div
                              class="h-0 my-2 border border-solid border-blueGray-100"
                            ></div>

                    <a

class="text-sm py-2 px-4 font-normal block w-full   whitespace-nowrap bg-transparent text-blueGray-700 "
>
<form action="{{ route('programmes.destroy', $programme->id) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit">Supprimer</button>
                    </form>
                    </a
>

                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

                @endif
              </div>
            </div>

          </div>









</div>





<x-footer></x-footer>



@endsection

