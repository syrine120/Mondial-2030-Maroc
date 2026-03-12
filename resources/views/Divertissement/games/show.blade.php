@extends('layouts.app')

@section('title', 'Match - ' . $game->equipe1 . ' vs ' . $game->equipe2)

@section('content')
<a href="{{ route('games.index') }}" class="btn btn-secondary mb-3">← Retour</a>

<div class="row">
  <div class="col-md-8">
    <div class="card shadow-sm">
      <div class="card-header bg-danger text-white text-center">
        <h2 class="mb-0">{{ $game->equipe1 }} <strong>VS</strong> {{ $game->equipe2 }}</h2>
      </div>
      <div class="card-body">
        <div class="row text-center">
          <div class="col-md-4">
            <h3>{{ $game->equipe1 }}</h3>
          </div>
          <div class="col-md-4">
            <h1 class="text-danger">⚽</h1>
            <p>VS</p>
          </div>
          <div class="col-md-4">
            <h3>{{ $game->equipe2 }}</h3>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-md-6">
            <p><strong>📍 Stade :</strong> {{ $game->stade->nom }}</p>
            <p><strong>🏘️ Ville :</strong> {{ $game->stade->ville->nom }}</p>
            <p><strong>👥 Capacité :</strong> {{ $game->stade->capacite }} places</p>
          </div>
          <div class="col-md-6">
            <p><strong>📅 Date :</strong> {{ \Carbon\Carbon::parse($game->date_match)->format('d/m/Y') }}</p>
            <p><strong>🕐 Heure :</strong> {{ $game->heure_match }}</p>
            <p><strong>🏆 Type :</strong> {{ $game->type_match }}</p>
          </div>
        </div>

        <div class="alert alert-info mt-3">
          <p class="mb-0">Adresse du stade : {{ $game->stade->adresse }}</p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    @auth
      <div class="card">
        <div class="card-header bg-warning text-white">Actions</div>
        <div class="card-body">
          <a href="{{ route('games.edit', $game->id) }}" class="btn btn-warning w-100 mb-2">✏️ Éditer</a>
          <form action="{{ route('games.destroy', $game->id) }}" method="POST">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Confirmer ?')">🗑️ Supprimer</button>
          </form>
        </div>
      </div>
    @endauth
  </div>
</div>
@endsection