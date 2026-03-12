@extends('layouts.app')

@section('title', $stade->nom . ' - Mondial 2030')

@section('content')
<div class="container my-4">
  <a href="{{ route('stades.index') }}" class="btn btn-outline-secondary mb-4">
    <i class="bi bi-arrow-left me-2"></i> Retour à la liste
  </a>

  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card shadow-lg border-0 rounded-3">
        @if($stade->image_url)
          <img src="{{ asset($stade->image_url) }}" alt="{{ $stade->nom }}" 
               class="card-img-top" style="max-height: 300px; width: 100%; object-fit: cover;">
        @endif

        <div class="card-body p-4">
          <h1 class="card-title fw-bold mb-3">{{ $stade->nom }}</h1>

          <div class="d-flex flex-wrap gap-3 mb-4">
            <span class="badge bg-info fs-5 px-3 py-2">Stade</span>
            <span class="badge bg-primary fs-5 px-3 py-2">Ville : {{ $stade->ville->nom ?? 'Non spécifiée' }}</span>
          </div>

          <div class="row g-4 mb-4">
            <div class="col-md-6">
              <p><strong><i class="bi bi-geo-alt-fill text-danger me-2"></i>Adresse :</strong> {{ $stade->adresse ?? 'Non spécifiée' }}</p>
              <p><strong><i class="bi bi-people-fill text-success me-2"></i>Capacité :</strong> {{ number_format($stade->capacite) }} places</p>
            </div>
          </div>

          <p><strong>Date d'ajout :</strong><br> {{ $stade->created_at?->format('d/m/Y H:i') ?? 'Non définie' }}</p>
        </div>
      </div>
    </div>

    <!-- Actions admin -->
    <div class="col-lg-4">
      @auth
        <div class="card shadow-sm border-0">
          <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Actions</h5>
          </div>
          <div class="card-body">
            <a href="{{ route('stades.edit', $stade->id) }}" class="btn btn-warning w-100 mb-2">
              <i class="bi bi-pencil me-2"></i> Éditer
            </a>
            <form action="{{ route('stades.destroy', $stade->id) }}" method="POST">
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