@extends('layouts.app')

@section('title', 'Matchs - Mondial 2030')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>⚽ Matchs du Mondial 2030</h1>
    @if(auth()->user()?->isAdmin())
      <a href="{{ route('games.create') }}" class="btn btn-danger">+ Ajouter un Match</a>
    @endif
  </div>

  <!-- Filtre par ville -->
  <div class="card mb-4">
    <div class="card-body">
      <form method="GET" action="{{ route('games.index') }}" class="row g-3 align-items-end">
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
            <a href="{{ route('games.index') }}" class="btn btn-secondary w-100">❌ Réinitialiser</a>
          </div>
        @endif
      </form>
    </div>
  </div>

  <div class="row g-4">
    @forelse($games as $game)
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          <div class="card-header bg-danger text-white">
            <h5 class="mb-0">{{ $game->equipe1 ?? 'TBD' }} vs {{ $game->equipe2 ?? 'TBD' }}</h5>
          </div>
          <div class="card-body">
            <p class="card-text">
              <strong>📍 Stade :</strong> {{ $game->stade->nom ?? 'N/A' }}<br>
              <strong>📅 Date :</strong> {{ \Carbon\Carbon::parse($game->date_match)->format('d/m/Y') }}<br>
              <strong>🕐 Heure :</strong> {{ $game->heure_match }}<br>
              <strong>🏆 Type :</strong> <span class="badge bg-info">{{ $game->type_match }}</span>
            </p>
          </div>
          <div class="card-footer bg-light">
            <div class="d-flex gap-2">
              <a href="{{ route('games.show', $game->id) }}" class="btn btn-sm btn-primary flex-grow-1">Détails</a>
              @if(auth()->user()?->isAdmin())
                <a href="{{ route('games.edit', $game->id) }}" class="btn btn-sm btn-warning">✏️</a>
                <form action="{{ route('games.destroy', $game->id) }}" method="POST" style="display:inline;">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer ?')">🗑️</button>
                </form>
              @endif
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="alert alert-info w-100">Aucun match disponible</div>
    @endforelse
  </div>
@endsection