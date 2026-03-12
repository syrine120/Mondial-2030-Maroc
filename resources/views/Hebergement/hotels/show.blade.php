@extends('layouts.app')

@section('title', $hotel->nom . ' - Mondial 2030')

@section('content')
<div class="container my-4">
  <a href="{{ route('hotels.index') }}" class="btn btn-outline-secondary mb-4">
    <i class="bi bi-arrow-left me-2"></i> Retour à la liste des hôtels
  </a>

  <div class="row g-4">
    <!-- Colonne principale -->
    <div class="col-lg-8">
      <div class="card shadow-lg border-0 rounded-3">
        <!-- Photo si elle existe -->
        @if($hotel->image_url)
          <img src="{{ asset($hotel->image_url) }}" alt="{{ $hotel->nom }}" 
               class="card-img-top" style="max-height: 300px; width: 100%; object-fit: cover;">
        @endif

        <div class="card-body p-4">
          <h1 class="card-title fw-bold mb-3">{{ $hotel->nom }}</h1>

          <div class="d-flex flex-wrap gap-3 mb-4">
            <span class="badge bg-info fs-5 px-3 py-2">{{ $hotel->type ?? 'Non spécifié' }}</span>
            <span class="badge bg-primary fs-5 px-3 py-2">Ville : {{ $hotel->ville->nom ?? 'Non spécifiée' }}</span>
          </div>

          <div class="row g-4 mb-4">
            <div class="col-md-6">
              <p><strong><i class="bi bi-geo-alt-fill text-danger me-2"></i>Adresse :</strong> {{ $hotel->adresse ?? 'Non spécifiée' }}</p>
              @if($hotel->prix_moyen)
                <p><strong><i class="bi bi-currency-euro text-success me-2"></i>Prix moyen :</strong> {{ $hotel->prix_moyen }} MAD</p>
              @endif
              @if($hotel->etoiles)
                <p><strong><i class="bi bi-star-fill text-warning me-2"></i>Étoiles :</strong> {{ $hotel->etoiles }}</p>
              @endif
            </div>
            <div class="col-md-6">
              @if($hotel->latitude && $hotel->longitude)
                <p><strong><i class="bi bi-geo-fill text-primary me-2"></i>Coordonnées :</strong> {{ $hotel->latitude }}, {{ $hotel->longitude }}</p>
              @endif
            </div>
          </div>

          <p><strong>Date d'ajout :</strong><br> {{ $hotel->created_at?->format('d/m/Y H:i') ?? 'Non définie' }}</p>
        </div>
      </div>
    </div>

    <!-- Colonne latérale actions admin -->
    <div class="col-lg-4">
      @auth
        <div class="card">
          <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Actions</h5>
          </div>
          <div class="card-body">
            <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-warning w-100 mb-2">
              <i class="bi bi-pencil me-2"></i> Éditer
            </a>
            <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Confirmer la suppression ?')">
                <i class="bi bi-trash me-2"></i> Supprimer
              </button>
            </form>
          </div>
        </div>
      @endauth
    </div>
  </div>
</div>
@endsection