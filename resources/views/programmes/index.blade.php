

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
                          Code
                        </th>
                        <th
                          class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                        >
                          ville
                        </th>
                        <th
                          class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                        >
                          par
                        </th>

                        <th
                          class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                        >
                          le
                        </th>
                        <th
                          class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                        >
                          Status
                        </th>
                        <th
                          class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                        >
                        Telecharger
                        </th>
                        <th
                          class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                        >

                          Date de publication
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
                          {{ $programme->code }}
                          </span>
                        </th>
                        <td
                          class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >


                          <div class="flex">
                          {{ $programme->ville->name_ville }}
        </div>

                        </td>
                        <td
                          class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                        <ul>
                        {{ $programme->user->name }}
                            </ul>
                        </td>
                        <td
                          class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                          <div class="flex">
                          {{ $programme->created_at }}
                          </div>
                        </td>
                        <td
                          class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                        @if($programme->is_publish == 0)
                          <div class="flex">
                          <form action="{{ route('programmes.publish', $programme->id) }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="bg-pink-500 active:bg-emerald-900 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150"
        onclick="return confirm('Voulez-vous vraiment publier ce programme ?')">
        Publier
    </button>
</form>

                          </div>
                          @else
                          <div class="flex">
        Deja Publier
        </div>
    @endif
                        </td>
                        <td
                          class=" border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                          <div class="flex">
                          @if($programme->image_one)
        <a href="{{ route('programmes.download', $programme) }}"  class=" bg-emerald-500  active:bg-emerald-900 uppercase text-white font-bold hover:shadow-md shadow text-xs px-2 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150">
            <i class="fas fa-download mr-1"></i> Télécharger
        </a>
    @else
        Aucun
    @endif
                          </div>
                        </td>
                        <td
                          class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                        <div class="flex">


    @if($programme->published_at)
    <span class="text-emerald-500">Publié le {{ $programme->published_at->translatedFormat(' d F Y à H:i') }}</span>
@else
    <span class="text-red-500">Non publié</span>
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
<form id="delete-form-{{ $programme->id }}"
      action="{{ route('programmes.destroy', $programme->id) }}"
      method="POST"
      style="display:none;">
    @csrf
    @method('DELETE')
</form>

<button type="button"
    onclick="confirmDelete('{{ $programme->id }}')"
    class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-red-600 hover:text-red-800">
    Supprimer
</button>

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






          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: "Cette action supprimera définitivement ce programme.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}




</script>



</div>





<x-footer></x-footer>



@endsection

