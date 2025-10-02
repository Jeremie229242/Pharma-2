





<nav class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4" >
          <div
            class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4"
          >
            <a
              class="text-white text-sm uppercase hidden lg:inline-block font-semibold"
              href="{{ route('apres.ville', ['ville' => Auth::user()->ville_id]) }}"
              >Dashboard</a
            >

            <ul
              class="flex-col md:flex-row list-none items-center hidden md:flex"
            >
              <a
                class="text-blueGray-500 block"
                href="#pablo"
                onclick="openDropdown(event,'user-dropdown')"
              >
                <div class="items-center flex text-white">{{Auth::user()->name}}
                  <span
                    class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full"
                    ><img
                      alt="..."
                      class="w-full rounded-full align-middle border-none shadow-lg"
                      src="{{asset('v1/img/team-1-800x800.jpg')}}"
                  />  </span>
                </div>
              </a>
              <div
                class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                id="user-dropdown"
              >
              @can("admin")

             

                <a
                  href="{{route('programmes.index')}}"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                  >Les Programmes</a
                >
                <a
                  href="{{route('programmes.para')}}"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                  >Les Pros</a
                >
  <a
    href="{{route('programmes.search')}}"
    class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
    >Recherche</a
  >



                @endcan

                <a
                  href="{{route('profile.edit')}}"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                  >Profile</a
                >
                <div
                  class="h-0 my-2 border border-solid border-blueGray-100"
                ></div>
                <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a
                  href="{{route('logout')}}"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                  onclick="event.preventDefault();
                                                this.closest('form').submit();"  >Deconnecter</a
                >

                </form>
              </div>
            </ul>
          </div>
        </nav>