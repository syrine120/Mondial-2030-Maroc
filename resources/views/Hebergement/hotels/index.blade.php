@extends('layouts.app')

@section('title', 'Hôtels - Mondial 2030')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>🏨 Hôtels</h1>
    @if(auth()->user()?->isAdmin())
      <a href="{{ route('hotels.create') }}" class="btn btn-primary">+ Ajouter un Hôtel</a>
    @endif
  </div>

  <!-- Filtre par ville -->
  <div class="card mb-4">
    <div class="card-body">
      <form method="GET" action="{{ route('hotels.index') }}" class="row g-3 align-items-end">
        <div class="col-md-4">
          <label for="ville_id" class="form-label">🏙️ Filtrer par ville</label>
          <select name="ville_id" id="ville_id" class="form-select">
            <option value="">Toutes les villes</option>
            @foreach($villes as $ville)
              <option value="{{ $ville->id }}" {{ request('ville_id') == $ville->id ? 'selected' : '' }}>
                {{ $ville->nom }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary w-100">🔍 Filtrer</button>
        </div>
        @if(request('ville_id'))
          <div class="col-md-2">
            <a href="{{ route('hotels.index') }}" class="btn btn-secondary w-100">❌ Réinitialiser</a>
          </div>
        @endif
      </form>
    </div>
  </div>

  <div class="row g-4">
    @forelse($hotels as $hotel)
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">{{ $hotel->nom }}</h5>
            <p class="card-text">
              <strong>🏙️ Ville :</strong> {{ $hotel->ville->nom }}<br>
              <strong>⭐ Étoiles :</strong> {{ $hotel->etoiles }}/5<br>
              <strong>💰 Prix :</strong> {{ $hotel->prix_nuit }} MAD/nuit<br>
              <strong>📱 Tél :</strong> {{ $hotel->telephone }}
            </p>
            <p class="text-muted small">{{ Str::limit($hotel->description, 80) }}</p>
          </div>
          <div class="card-footer bg-light">
            <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-sm btn-primary">Détails</a>
          </div>
        </div>
      </div>
    @empty
      <div class="alert alert-info w-100">Aucun hôtel disponible</div>
    @endforelse
  </div>
@endsection