<x-app-layout>
    <x-slot name="header">
        <h2>Editer la pharmacie</h2>
    </x-slot>


<div class="container">
    <h1 class="mb-4 text-primary">🔍 Recherche Pharmacies de Garde</h1>

    <!-- Formulaire de recherche -->
    <form method="GET" action="{{ route('programmes.search') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="date_debut" class="form-label">Date début</label>
            <input type="date" name="date_debut" id="date_debut" value="{{ request('date_debut') }}" class="form-control">
        </div>

        <div class="col-md-4">
            <label for="date_fin" class="form-label">Date fin</label>
            <input type="date" name="date_fin" id="date_fin" value="{{ request('date_fin') }}" class="form-control">
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Rechercher</button>
        </div>
    </form>

    <!-- Résultats -->
    @if($programmes->count() > 0)
        <div class="accordion" id="programmesAccordion">
            @foreach($programmes as $programme)
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="heading{{ $programme->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $programme->id }}" aria-expanded="false" aria-controls="collapse{{ $programme->id }}">
                            📅 Semaine du {{ \Carbon\Carbon::parse($programme->date_debut)->format('d/m/Y') }}
                            au {{ \Carbon\Carbon::parse($programme->date_fin)->format('d/m/Y') }}
                            — Commune : {{ $programme->commune->nom }}
                        </button>
                    </h2>
                    <div id="collapse{{ $programme->id }}" class="accordion-collapse collapse"
                         aria-labelledby="heading{{ $programme->id }}" data-bs-parent="#programmesAccordion">
                        <div class="accordion-body">
                            <ul>
                                @foreach($programme->pharmacies as $pharmacie)
                                    <li>
                                        <strong>{{ $pharmacie->nom_pharmacie }}</strong><br>
                                        📍 {{ $pharmacie->adresse }}
                                        <strong>{{ $pharmacie->nom_pharmacie }}</strong><br>

                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="alert alert-warning">⚠️ Aucun programme trouvé pour la période sélectionnée.</p>
    @endif
</div>
</x-app-layout>
