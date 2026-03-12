@extends('layouts.app')

@section('title', $pharmacie->nom . ' - Mondial 2030')

@section('content')
<a href="{{ route('pharmacies.index') }}" class="btn btn-secondary mb-3">← Retour</a>

<div class="container my-4">
  <div class="card shadow-lg">
    <div class="card-body">
      <h1>{{ $pharmacie->nom }}</h1>

      <div class="row mt-4">
        <div class="col-md-6">
          <p><strong>🏙️ Ville :</strong> {{ $pharmacie->ville->nom }}</p>
          <p><strong>📍 Adresse :</strong> {{ $pharmacie->adresse }}</p>
          <p><strong>📱 Téléphone :</strong> {{ $pharmacie->telephone }}</p>
        </div>
        <div class="col-md-6">
          <p><strong>🕐 Ouverture :</strong> {{ $pharmacie->horaires_ouverture }}</p>
          <p><strong>🕒 Fermeture :</strong> {{ $pharmacie->horaires_fermeture }}</p>
          @if($pharmacie->latitude && $pharmacie->longitude)
            <p><strong>Coordonnées :</strong> {{ $pharmacie->latitude }}, {{ $pharmacie->longitude }}</p>
          @endif
        </div>
      </div>

      <div class="mt-4">
        <p><strong>Date d'ajout :</strong><br> {{ $pharmacie->created_at?->format('d/m/Y H:i') ?? 'Non définie' }}</p>
      </div>
    </div>
  </div>
</div>
@endsection