@extends('layouts.app')

@section('title', 'Pharmacies')

@section('content')
<h1>💊 Pharmacies Ouvertes</h1>

<!-- Filtre par ville -->
<div class="card mb-4">
  <div class="card-body">
    <form method="GET" action="{{ route('pharmacies.index') }}" class="row g-3 align-items-end">
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
          <a href="{{ route('pharmacies.index') }}" class="btn btn-secondary w-100">❌ Réinitialiser</a>
        </div>
      @endif
    </form>
  </div>
</div>

<div class="row g-4">
  @forelse($pharmacies as $pharmacie)
    <div class="col-md-6 col-lg-4">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title">{{ $pharmacie->nom }}</h5>
          <p class="card-text">
            <strong>🏙️ Ville :</strong> {{ $pharmacie->ville->nom }}<br>
            <strong>📍 Adresse :</strong> {{ $pharmacie->adresse }}<br>
            <strong>📱 Tél :</strong> {{ $pharmacie->telephone }}<br>
            <strong>🕐 Ouverture :</strong> {{ $pharmacie->horaires_ouverture }}<br>
            <strong>🕒 Fermeture :</strong> {{ $pharmacie->horaires_fermeture }}
          </p>
        </div>
      </div>
    </div>
  @empty
    <div class="alert alert-info w-100">Aucune pharmacie disponible</div>
  @endforelse
</div>
@endsection