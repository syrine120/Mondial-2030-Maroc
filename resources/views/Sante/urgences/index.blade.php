@extends('layouts.app')

@section('title', 'Urgences')

@section('content')
<h1>🚨 Numéros d'Urgence</h1>

<!-- Filtre par ville -->
<div class="card mb-4">
  <div class="card-body">
    <form method="GET" action="{{ route('urgences.index') }}" class="row g-3 align-items-end">
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
          <a href="{{ route('urgences.index') }}" class="btn btn-secondary w-100">❌ Réinitialiser</a>
        </div>
      @endif
    </form>
  </div>
</div>

<div class="row g-3">
  @forelse($urgences as $urgence)
    <div class="col-md-6 col-lg-4">
      <div class="card border-danger">
        <div class="card-header bg-danger text-white">
          <h5 class="mb-0">{{ $urgence->type }}</h5>
        </div>
        <div class="card-body">
          <h3 class="text-danger">{{ $urgence->numero }}</h3>
          <p>{{ $urgence->description }}</p>
          @if($urgence->ville)
            <small class="text-muted">{{ $urgence->ville->nom }}</small>
          @endif
        </div>
      </div>
    </div>
  @empty
    <div class="alert alert-info w-100">Aucun numéro disponible</div>
  @endforelse
</div>
@endsection