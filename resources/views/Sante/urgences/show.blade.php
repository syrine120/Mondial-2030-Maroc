@extends('layouts.app')

@section('title', $urgence->nom . ' - Mondial 2030')

@section('content')
<a href="{{ route('urgences.index') }}" class="btn btn-secondary mb-3">← Retour</a>

<div class="container my-4">
  <div class="card shadow-lg">
    <div class="card-header bg-danger text-white">
      <h3 class="mb-0">{{ $urgence->nom }}</h3>
    </div>

    <div class="card-body p-4">
      <div class="row g-4 mb-4">
        <div class="col-md-6">
          <p><strong>📍 Adresse :</strong> {{ $urgence->adresse ?? 'Non spécifiée' }}</p>
          <p><strong>📱 Téléphone :</strong> {{ $urgence->telephone ?? 'Non spécifié' }}</p>
        </div>
        <div class="col-md-6">
          <p><strong>🏙️ Ville :</strong> {{ $urgence->ville->nom ?? 'Non spécifiée' }}</p>
          @if($urgence->latitude && $urgence->longitude)
            <p><strong>Coordonnées :</strong> {{ $urgence->latitude }}, {{ $urgence->longitude }}</p>
          @endif
        </div>
      </div>

      @if($urgence->description)
        <div class="alert alert-info mt-4">
          <h5>📝 Description</h5>
          <p class="mb-0">{{ $urgence->description }}</p>
        </div>
      @endif

      <div class="mt-4">
        <p><strong>Date d'ajout :</strong><br> {{ $urgence->created_at?->format('d/m/Y H:i') ?? 'Non définie' }}</p>
      </div>
    </div>
  </div>
</div>
@endsection