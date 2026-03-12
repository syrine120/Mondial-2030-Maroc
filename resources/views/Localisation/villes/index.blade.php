@extends('layouts.app')

@section('title', 'Villes - Mondial 2030 Maroc')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>🏙️ Les Villes du Maroc pour le Mondial 2030</h1>
    @if(auth()->user()?->isAdmin())
      <a href="{{ route('villes.create') }}" class="btn btn-success">+ Ajouter une Ville</a>
    @endif
  </div>

  <div class="row g-4">
    @forelse($villes as $ville)
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          @if($ville->image_url)
            <img src="{{ $ville->image_url }}" class="card-img-top" alt="{{ $ville->nom }}"
              style="height: 200px; object-fit: cover;">
          @else
            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
              <h2>{{ substr($ville->nom, 0, 1) }}</h2>
            </div>
          @endif
          <div class="card-body">
            <h5 class="card-title">{{ $ville->nom }}</h5>
            <p class="card-text">{{ Str::limit($ville->description, 100) }}</p>
            <div class="d-flex gap-2">
              <a href="{{ route('villes.show', $ville->id) }}" class="btn btn-primary btn-sm">Voir détails</a>
              @if(auth()->user()?->isAdmin())
                <a href="{{ route('villes.edit', $ville->id) }}" class="btn btn-warning btn-sm">Éditer</a>
                <form action="{{ route('villes.destroy', $ville->id) }}" method="POST" style="display:inline;">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                </form>
              @endif
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="alert alert-info w-100">Aucune ville disponible pour le moment</div>
    @endforelse
  </div>
@endsection