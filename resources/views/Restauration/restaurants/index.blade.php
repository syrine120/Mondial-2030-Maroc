@extends('layouts.app')

@section('title', 'Restaurants - Mondial 2030')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>🍽️ Restaurants</h1>
    @if(auth()->user()?->isAdmin())
      <a href="{{ route('restaurants.create') }}" class="btn btn-primary">+ Ajouter un Restaurant</a>
    @endif
  </div>

  <!-- Filtre par ville -->
  <div class="card mb-4">
    <div class="card-body">
      <form method="GET" action="{{ route('restaurants.index') }}" class="row g-3 align-items-end">
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
            <a href="{{ route('restaurants.index') }}" class="btn btn-secondary w-100">❌ Réinitialiser</a>
          </div>
        @endif
      </form>
    </div>
  </div>

  <div class="row g-4">
    @forelse($restaurants as $restaurant)
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          @if($restaurant->image_url)
            <img src="{{ $restaurant->image_url }}" class="card-img-top" alt="{{ $restaurant->nom }}"
              style="height: 200px; object-fit: cover;">
          @endif
          <div class="card-body">
            <h5 class="card-title">{{ $restaurant->nom }}</h5>
            <p class="card-text">
              <strong>🏙️ Ville :</strong> {{ $restaurant->ville->nom }}<br>
              <strong>🍴 Type :</strong> {{ $restaurant->type_cuisine }}<br>
              <strong>💰 Prix moyen :</strong> {{ $restaurant->prix_moyen }} MAD<br>
              <strong>📱 Tél :</strong> {{ $restaurant->telephone }}
            </p>
            <p class="text-muted small">{{ Str::limit($restaurant->description, 80) }}</p>
          </div>
          <div class="card-footer bg-light">
            <div class="d-flex gap-2">
              <a href="{{ route('restaurants.show', $restaurant->id) }}"
                class="btn btn-sm btn-primary flex-grow-1">Détails</a>
              @if(auth()->user()?->isAdmin())
                <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="btn btn-sm btn-warning">✏️</a>
                <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" style="display:inline;">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer ?')">🗑️</button>
                </form>
              @endif
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="alert alert-info w-100">Aucun restaurant disponible</div>
    @endforelse
  </div>
@endsection