
@extends("layouts.appdash")
@section('title','PRO-PHARMA | Villes')
@section("content")



  <style>

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  line-height: 1.6;
  background: #f0f0f0;
  color: #333;
}

.container {
  display: flex;
  flex-wrap: wrap;
}

/* --- Colonne gauche --- */
.left-panel {
    flex: 1;
  min-width: 280px;
  background: url("building.jpg") no-repeat center bottom;
  background-size: cover;
  color: #444;
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 20px;
}

.left-panel h2 {
  color: #006400;
  font-size: 1.5rem;
  margin: 10px 0;
}

.left-panel span {
  color: #c00;
}
.left-panel::before {
  content: "";
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(255,255,255,0.85);
  z-index: 1;
}
.left-panel > * {
  position: relative;
  z-index: 2;
  text-align: center;
}

.date-text {
  font-size: 0.9rem;
  margin: 10px 0;
}

.building img {
  width: 100%;
  max-height: 250px;
  object-fit: cover;
  border-radius: 6px;
}

/* --- Colonne droite --- */
.right-panel {
  flex: 3;
  min-width: 300px;
  padding: 20px;
}

.title {
  text-align: center;
  margin-bottom: 20px;
}

.title h1 {
  font-size: 1.4rem;
  color: #004080;
}

.subtitle {
  font-size: 1rem;
  color: #c00;
  font-weight: bold;
  margin-top: 5px;
}

.pharmacies {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
}

.pharmacies h3 {
  color: #004080;
  font-size: 1rem;
  margin-bottom: 8px;
  border-bottom: 2px solid #eee;
}

.pharmacies ul {
  list-style: none;
}

.pharmacies li {
  margin-bottom: 6px;
  font-size: 0.9rem;
}

.red {
  color: #c00;
  font-weight: bold;
}

.footer {
  text-align: center;
  margin-top: 20px;
  font-size: 0.9rem;
  color: #444;
}

.footer img {
  max-width: 150px;
  margin-bottom: 10px;
}

</style>

<div class="relative bg-emerald-500 md:pt-32 pb-32 pt-12">


</div>


  <div class="container">
    <!-- Colonne gauche -->
    <aside class="left-panel">
      <div class="indep-box">
        <div class="map-logo">
        @if(!empty($info->image_one) && file_exists(public_path($info->image_one)))
            <img src="{{ asset($info->image_one) }}" alt="Image 1" >
        @else
            <img src="" alt="Image 1" width="100" id="image_one_preview" style="display:none;">
        @endif
        </div>
        <h2>{{ $info->name_Info }}<br><span>1960 - 2025</span></h2>
        <p class="date-text">{{ $info->content_Info }}</p>
        <div class="building">
        @if(!empty($info->image_two) && file_exists(public_path($info->image_two)))
            <img src="{{ asset($info->image_two) }}" alt="Image 2" width="100" id="image_two_preview">
        @else
            <img src="" alt="Image 2" width="100" id="image_two_preview" style="display:none;">
        @endif

        </div>
      </div>
    </aside>

    <!-- Colonne droite -->
    <main class="right-panel">
      <header class="title">
        <h1>PROGRAMME DES PHARMACIES<br>DE GARDE DE POINTE-NOIRE</h1>
        <p class="subtitle">📅 Période :
        du {{ \Carbon\Carbon::parse($programmes->first()->date_debut)->format('d/m/Y') }}
        au {{ \Carbon\Carbon::parse($programmes->last()->date_fin)->format('d/m/Y') }}</p>
      </header>

      <section class="pharmacies">
      @foreach($programmes as $programme)
        <div class="col">
          <h3>ARRD. N° 1<br>{{ $programme->commune->name_commune }}</h3>
          <ul>
            @foreach($programme->pharmacies as $pharmacie)
                                    <li>
                                        <span class="red">📍 {{ $pharmacie->name_pharmacie }}</span>
                                         {{ $pharmacie->adresse }}

                                    </li>
                                @endforeach
        </ul>
        </div>

        @endforeach
      </section>

      <footer class="footer">
        <div class="logo">
          <img src="citadelle-logo.png" alt="Citadelle">
        </div>
        <p>{{ $info->tel_Info }}<br>{{ $info->adresse1_Info }}</p>
      </footer>
    </main>

  </div>
  @endsection
