@extends('layouts.app')

@section('title', $restaurant->nom . ' - Mondial 2030')

@section('content')
<a href="{{ route('restaurants.index') }}" class="btn btn-secondary mb-3">← Retour</a>

<div class="row">
  <div class="col-md-8">
    <div class="card shadow-sm">
      @if($restaurant->image_url)
        <img src="{{ $restaurant->image_url }}" class="card-img-top" alt="{{ $restaurant->nom }}" style="height: 300px; object-fit: cover;">
      @endif
      <div class="card-body">
        <h1>{{ $restaurant->nom }}</h1>
        <p class="lead">{{ $restaurant->description }}</p>

        <div class="row mt-4">
          <div class="col-md-6">
            <p><strong>🍴 Type de cuisine :</strong> {{ $restaurant->type_cuisine }}</p>
            <p><strong>💰 Prix moyen :</strong> {{ $restaurant->prix_moyen }} MAD</p>
            <p><strong>📱 Téléphone :</strong> {{ $restaurant->telephone }}</p>
            <p><strong>📧 Email :</strong> <a href="mailto:{{ $restaurant->email }}">{{ $restaurant->email }}</a></p>
          </div>
          <div class="col-md-6">
            <p><strong>🏙️ Ville :</strong> {{ $restaurant->ville->nom }}</p>
            <p><strong>📍 Adresse :</strong> {{ $restaurant->adresse }}</p>
            <p><strong>🕐 Horaires :</strong> {{ $restaurant->horaires }}</p>
          </div>
        </div>

        <div class="alert alert-info mt-4">
          <h5>📝 À propos</h5>
          <p class="mb-0">{{ $restaurant->description }}</p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    @auth
      <div class="card">
        <div class="card-header bg-warning text-white">
          <h5 class="mb-0">Actions</h5>
        </div>
        <div class="card-body">
          <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="btn btn-warning w-100 mb-2">✏️ Éditer</a>
          <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Supprimer ce restaurant ?')">🗑️ Supprimer</button>
          </form>
        </div>
      </div>
    @endauth

    <div class="card mt-3">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">ℹ️ Informations</h5>
      </div>
      <div class="card-body">
        <p><strong>Date d'ajout :</strong><br> {{ $restaurant->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>Dernière mise à jour :</strong><br> {{ $restaurant->updated_at->format('d/m/Y H:i') }}</p>
      </div>
    </div>
  </div>
</div>
@endsection