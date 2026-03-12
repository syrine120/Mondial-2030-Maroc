@extends('layouts.app')

@section('title', $endroit->nom . ' - Mondial 2030')

@section('content')
<div class="container my-4">
  <a href="{{ route('endroits.index') }}" class="btn btn-outline-secondary mb-4">
    <i class="bi bi-arrow-left me-2"></i> Retour à la liste
  </a>

  <div class="row g-4">
    <!-- Colonne principale : titre + infos -->
    <div class="col-lg-8">
      <div class="card shadow-lg border-0 rounded-3">
        <!-- Photo : seulement si elle existe -->
        @if($endroit->image_url)
          <img src="{{ asset($endroit->image_url) }}" alt="{{ $endroit->nom }}" 
               class="card-img-top" style="max-height: 350px; width: 100%; object-fit: cover;">
        @endif

        <div class="card-body p-4">
          <h1 class="card-title fw-bold mb-3">{{ $endroit->nom }}</h1>

          <div class="d-flex flex-wrap gap-3 mb-4">
            <span class="badge bg-info fs-5 px-3 py-2">{{ $endroit->type ?? 'Non spécifié' }}</span>
            <span class="badge bg-primary fs-5 px-3 py-2">Ville : {{ $endroit->ville->nom ?? 'Non spécifiée' }}</span>
          </div>

          <div class="row g-4 mb-4">
            <div class="col-md-6">
              <p><strong><i class="bi bi-geo-alt-fill text-danger me-2"></i>Adresse :</strong> {{ $endroit->adresse ?? 'Non spécifiée' }}</p>
              @if($endroit->telephone)
                <p><strong><i class="bi bi-telephone-fill text-success me-2"></i>Téléphone :</strong> {{ $endroit->telephone }}</p>
              @endif
            </div>
            <div class="col-md-6">
              @if($endroit->horaires)
                <p><strong><i class="bi bi-clock-fill text-warning me-2"></i>Horaires :</strong> {{ $endroit->horaires }}</p>
              @endif
              @if($endroit->latitude && $endroit->longitude)
                <p><strong><i class="bi bi-geo-fill text-primary me-2"></i>Coordonnées :</strong> {{ $endroit->latitude }}, {{ $endroit->longitude }}</p>
              @endif
            </div>
          </div>

          <div class="mt-4">
            <p><strong>Date d'ajout :</strong><br> {{ $endroit->created_at?->format('d/m/Y H:i') ?? 'Non définie' }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Colonne latérale : actions admin -->
    <div class="col-lg-4">
      @auth
        <div class="card shadow-sm border-0">
          <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Actions</h5>
          </div>
          <div class="card-body">
            <a href="{{ route('endroits.edit', $endroit->id) }}" class="btn btn-warning w-100 mb-2">
              <i class="bi bi-pencil me-2"></i> Éditer
            </a>
            <form action="{{ route('endroits.destroy', $endroit->id) }}" method="POST">
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