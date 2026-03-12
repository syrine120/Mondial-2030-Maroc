@extends('layouts.app')

@section('title', $ville->nom . ' - Mondial 2030')

@section('content')
<a href="{{ route('villes.index') }}" class="btn btn-secondary mb-3">← Retour</a>

<div class="row">
  <div class="col-md-8">
    <h1>{{ $ville->nom }}</h1>
    <p class="lead">{{ $ville->description }}</p>

    @if($ville->stades->count() > 0)
      <h3 class="mt-4">⚽ Stades</h3>
      <div class="row">
        @foreach($ville->stades as $stade)
          <div class="col-md-6 mb-3">
            <div class="card">
              <div class="card-body">
                <h5>{{ $stade->nom }}</h5>
                <p><strong>Capacité :</strong> {{ $stade->capacite }} places</p>
                <p>{{ $stade->adresse }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif

    @if($ville->hotels->count() > 0)
      <h3 class="mt-4">🏨 Hôtels</h3>
      <div class="row">
        @foreach($ville->hotels as $hotel)
          <div class="col-md-6 mb-3">
            <div class="card">
              <div class="card-body">
                <h5>{{ $hotel->nom }}</h5>
                <p>⭐ {{ $hotel->etoiles }}/5</p>
                <p><strong>Prix :</strong> {{ $hotel->prix_nuit }} MAD/nuit</p>
                <p>{{ $hotel->telephone }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif

    @if($ville->restaurants->count() > 0)
      <h3 class="mt-4">🍽️ Restaurants</h3>
      <div class="row">
        @foreach($ville->restaurants as $restaurant)
          <div class="col-md-6 mb-3">
            <div class="card">
              <div class="card-body">
                <h5>{{ $restaurant->nom }}</h5>
                <p><strong>Type :</strong> {{ $restaurant->type_cuisine }}</p>
                <p><strong>Prix moyen :</strong> {{ $restaurant->prix_moyen }} MAD</p>
                <p>{{ $restaurant->telephone }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">📍 Informations</h5>
      </div>
      <div class="card-body">
        @if($ville->latitude && $ville->longitude)
          <p><strong>Latitude :</strong> {{ $ville->latitude }}</p>
          <p><strong>Longitude :</strong> {{ $ville->longitude }}</p>
        @endif
        <p><strong>Stades :</strong> {{ $ville->stades->count() }}</p>
        <p><strong>Hôtels :</strong> {{ $ville->hotels->count() }}</p>
        <p><strong>Restaurants :</strong> {{ $ville->restaurants->count() }}</p>
      </div>
    </div>
  </div>
</div>
@endsection