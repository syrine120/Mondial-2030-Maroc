@extends('layouts.app')

@section('title', $airbnb->nom . ' - Mondial 2030')

@section('content')
<a href="{{ route('airbnbs.index') }}" class="btn btn-secondary mb-3">← Retour</a>

<div class="row">
  <div class="col-md-8">
    <div class="card shadow-sm">
      @if($airbnb->image_url)
        <img src="{{ $airbnb->image_url }}" class="card-img-top" alt="{{ $airbnb->nom }}" style="height: 300px; object-fit: cover;">
      @endif
      <div class="card-body">
        <h1>{{ $airbnb->nom }}</h1>
        <p class="lead">{{ $airbnb->description }}</p>

        <div class="row mt-4">
          <div class="col-md-6">
            <p><strong>🏙️ Ville :</strong> {{ $airbnb->ville->nom }}</p>
            <p><strong>🛏️ Chambres :</strong> {{ $airbnb->chambres }}</p>
            <p><strong>👥 Capacité :</strong> {{ $airbnb->capacite }} personnes</p>
            <p><strong>💰 Prix :</strong> {{ $airbnb->prix_nuit }} MAD/nuit</p>
          </div>
          <div class="col-md-6">
            <p><strong>📍 Adresse :</strong> {{ $airbnb->adresse }}</p>
            <p><strong>📱 Propriétaire :</strong> {{ $airbnb->proprietaire }}</p>
            <p><strong>☎️ Téléphone :</strong> {{ $airbnb->telephone }}</p>
          </div>
        </div>

        <div class="alert alert-info mt-4">
          <h5>📝 Description</h5>
          <p class="mb-0">{{ $airbnb->description }}</p>
        </div>

        <div class="alert alert-success mt-3">
          <h5>💰 Prix Total (7 nuits)</h5>
          <h4 class="mb-0">{{ $airbnb->prix_nuit * 7 }} MAD</h4>
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
          <a href="{{ route('airbnbs.edit', $airbnb->id) }}" class="btn btn-warning w-100 mb-2">✏️ Éditer</a>
          <form action="{{ route('airbnbs.destroy', $airbnb->id) }}" method="POST">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Supprimer cet Airbnb ?')">🗑️ Supprimer</button>
          </form>
        </div>
      </div>
    @endauth

    <div class="card mt-3">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">ℹ️ Informations</h5>
      </div>
      <div class="card-body">
        <p><strong>Équipements :</strong></p>
        <ul>
          <li>🛏️ {{ $airbnb->chambres }} chambre(s)</li>
          <li>👥 {{ $airbnb->capacite }} personne(s)</li>
          <li>💰 {{ $airbnb->prix_nuit }} MAD/nuit</li>
        </ul>
        <p><strong>Propriétaire :</strong> {{ $airbnb->proprietaire }}</p>
      </div>
    </div>
  </div>
</div>
@endsection