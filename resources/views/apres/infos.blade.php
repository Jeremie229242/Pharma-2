



@extends("layouts.appdash")
@section('title','PRO-PHARMA | LOGIN')
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
                <form action="{{ route('infos.storeOrUpdate') }}" method="POST" enctype="multipart/form-data">
        @csrf

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
                            name="name_Info"
                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"

                            value="{{ old('name_Info', $info->name_Info ?? '') }}"
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
                            Telephone
                          </label>
                          <input
                            type="text"
                           name="tel_Info"
                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"

                            value="{{ old('tel_Info', $info->tel_Info ?? '') }}"
                            required
                          />
                        </div>
                      </div>
                    </div>


                    <div class="flex flex-wrap">
                      <div class="w-full lg:w-6/12 px-4">
                        <div class="relative w-full mb-3">
                          <label
                            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                            htmlFor="grid-password"
                          >
                            Adresse 1
                          </label>
                          <input
                            type="text"
                            name="adresse1_Info"
                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"

                            value="{{ old('adresse1_Info', $info->adresse1_Info ?? '') }}"
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
                            Adresse 2
                          </label>
                          <input
                            type="text"
                            name="adresse12_Info"
                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"

                             value="{{ old('adresse12_Info', $info->adresse12_Info ?? '') }}"
                            required
                          />
                        </div>
                      </div>
                    </div>

                    <div class="flex flex-wrap">
                      <div class="w-full lg:w-6/12 px-4">
                        <div class="relative w-full mb-3">
                          <label
                            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                            htmlFor="grid-password"
                          >
                            Image 1
                          </label>
                          <input
                            type="file"
                            name="image_one"
                            id="image_one_input"
                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"



                          />
                          <div class="mt-2">
        @if(!empty($info->image_one) && file_exists(public_path($info->image_one)))
            <img src="{{ asset($info->image_one) }}" alt="Image 1" width="100" id="image_one_preview">
        @else
            <img src="" alt="Image 1" width="100" id="image_one_preview" style="display:none;">
        @endif
    </div>
                        </div>
                      </div>
                      <div class="w-full lg:w-6/12 px-4">
                        <div class="relative w-full mb-3">
                          <label
                            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                            htmlFor="grid-password"
                          >
                            Image 2
                          </label>
                          <input
                            type="file"
                            name="image_two"
                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"

                            id="image_two_input"
                            
                          />
                          <div class="mt-2">
        @if(!empty($info->image_two) && file_exists(public_path($info->image_two)))
            <img src="{{ asset($info->image_two) }}" alt="Image 2" width="100" id="image_two_preview">
        @else
            <img src="" alt="Image 2" width="100" id="image_two_preview" style="display:none;">
        @endif
    </div>
                        </div>
                      </div>
                    </div>

                    <div class="flex flex-wrap">
                      <div class="w-full lg:w-12/12 px-4">
                        <div class="relative w-full mb-3">
                          <label
                            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                            htmlFor="grid-password"
                          >
                            Contenu
                          </label>

                          <textarea name="content_Info"
                          class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                          >{{ old('content_Info', $info->content_Info ?? '') }}</textarea>

                        </div>
                      </div>

                    </div>
                    <hr class="mt-6 border-b-1 border-blueGray-300" />



                    <div class="rounded-t  mb-0 px-6 py-6">
                  <div class="text-center flex justify-between">

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
          <script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'inline-block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}

document.getElementById('image_one_input').addEventListener('change', function() {
    previewImage(this, 'image_one_preview');
});

document.getElementById('image_two_input').addEventListener('change', function() {
    previewImage(this, 'image_two_preview');
});


</script>
        </div>




          @endsection
