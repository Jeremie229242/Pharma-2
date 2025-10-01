<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Programme des Pharmacies de Garde - {{ $programme->commune->ville->name_ville }}</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f4f4f4;
      color: #333;
    }
    header {
      background: #005f99;
      color: white;
      text-align: center;
      padding: 20px;
    }
    header h1 {
      margin: 0;
      font-size: 1.4rem;
    }
    header p {
      margin: 5px 0 0;
      font-size: 1rem;
    }

    .container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 15px;
      padding: 20px;
    }

    .card {
      background: white;
      border-radius: 8px;
      padding: 15px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .card h2 {
      font-size: 1.1rem;
      margin-bottom: 10px;
      color: #005f99;
      border-bottom: 2px solid #eee;
      padding-bottom: 5px;
    }

    .card ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .card ul li {
      padding: 6px 0;
      border-bottom: 1px dashed #ddd;
      font-size: 0.95rem;
    }

    .card ul li:last-child {
      border-bottom: none;
    }

    footer {
      text-align: center;
      background: #005f99;
      color: white;
      padding: 10px;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

  <header>
    <h1>Programme des Pharmacies de Garde - {{ $programme->commune->ville->name_ville }}</h1>
    <p>
      Du {{ \Carbon\Carbon::parse($programme->date_debut)->translatedFormat('l d F Y') }}
      au {{ \Carbon\Carbon::parse($programme->date_fin)->translatedFormat('l d F Y') }}
    </p>
  </header>

  <div class="container">

    {{-- Une seule commune (celle du programme) --}}
    <div class="card">
      <h2>{{ $programme->commune->name_commune }}</h2>
      <ul>
        @foreach($programme->pharmacies as $pharmacie)
          <li>{{ $pharmacie->name_pharmacie }}
            @if($pharmacie->adresse)
              ({{ $pharmacie->adresse }})
            @endif
          </li>
        @endforeach
      </ul>
    </div>

  </div>

  <footer>
    &copy; {{ now()->year }} République du Congo – Pharmacies de Garde à {{ $programme->commune->ville->name_ville }}
  </footer>

</body>
</html>
