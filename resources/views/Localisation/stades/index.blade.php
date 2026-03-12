@extends('layouts.app')

@section('title', 'Stades - Mondial 2030')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>🏟️ Stades</h1>
    @if(auth()->user()?->isAdmin())
      <a href="{{ route('stades.create') }}" class="btn btn-success">+ Ajouter un Stade</a>
    @endif
  </div>

  <!-- Filtre par ville -->
  <div class="card mb-4">
    <div class="card-body">
      <form method="GET" action="{{ route('stades.index') }}" class="row g-3 align-items-end">
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
            <a href="{{ route('stades.index') }}" class="btn btn-secondary w-100">❌ Réinitialiser</a>
          </div>
        @endif
      </form>
    </div>
  </div>

  <div class="row g-4">
    @forelse($stades as $stade)
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          @if($stade->image_url)
            <img src="{{ asset($stade->image_url) }}" class="card-img-top" alt="{{ $stade->nom }}"
              style="height: 200px; object-fit: cover;">
          @else
            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
              <i class="bi bi-building fs-1 text-muted"></i>
            </div>
          @endif
          <div class="card-body">
            <h5 class="card-title">{{ $stade->nom }}</h5>
            <p class="card-text">
              <strong>🏙️ Ville :</strong> {{ $stade->ville->nom }}<br>
              <strong>👥 Capacité :</strong> {{ number_format($stade->capacite) }} places
            </p>
          </div>
          <div class="card-footer bg-light text-center">
            <a href="{{ route('stades.show', $stade->id) }}" class="btn btn-primary btn-sm">Voir détails</a>
          </div>
        </div>
      </div>
    @empty
      <div class="alert alert-info w-100">Aucun stade disponible</div>
    @endforelse
  </div>
@endsection