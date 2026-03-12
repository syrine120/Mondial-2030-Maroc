@extends('layouts.app')

@section('title', 'Endroits à Visiter - Mondial 2030')

@section('content')
<style>
  .endroit-card {
    transition: all 0.3s ease;
    border: none;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  }

  .endroit-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
  }

  .card-img-top {
    height: 220px;
    object-fit: cover;
    transition: transform 0.4s ease;
  }

  .endroit-card:hover .card-img-top {
    transform: scale(1.08);
  }

  .badge-type {
    font-size: 0.9rem;
    padding: 6px 12px;
  }

  .btn-details {
    background: #c1272d;
    border: none;
    transition: background 0.3s;
  }

  .btn-details:hover {
    background: #a01f25;
  }

  .placeholder-img {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    height: 220px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    font-size: 3rem;
  }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h1>🎫 Endroits à Visiter</h1>
  @auth
    <a href="{{ route('endroits.create') }}" class="btn btn-success">+ Ajouter un Endroit</a>
  @endauth
</div>

<!-- Filtre par ville -->
<div class="mb-4">
  <form method="GET" class="row g-3">
    <div class="col-md-6">
      <select name="ville_id" class="form-select" onchange="this.form.submit()">
        <option value="">-- Tous les endroits --</option>
        @foreach($villes as $ville)
          <option value="{{ $ville->id }}" {{ request('ville_id') == $ville->id ? 'selected' : '' }}>
            {{ $ville->nom }}
          </option>
        @endforeach
      </select>
    </div>
  </form>
</div>

<div class="row g-4">
  @forelse($endroits as $endroit)
    <div class="col-md-6 col-lg-4">
      <div class="card endroit-card h-100">
        @if($endroit->image_url)
          <img src="{{ asset($endroit->image_url) }}" class="card-img-top" alt="{{ $endroit->nom }}">
        @else
          <div class="placeholder-img">
            <i class="bi bi-image"></i>
          </div>
        @endif

        <div class="card-body">
          <h5 class="card-title fw-bold">{{ $endroit->nom }}</h5>
          <p class="card-text">
            <strong><i class="bi bi-geo-alt-fill text-primary me-1"></i> Ville :</strong> {{ $endroit->ville->nom ?? 'Non spécifiée' }}<br>
            <strong><i class="bi bi-tag-fill text-info me-1"></i> Type :</strong> 
            <span class="badge bg-info badge-type">{{ $endroit->type ?? 'Non spécifié' }}</span><br>
            <strong><i class="bi bi-geo-fill text-danger me-1"></i> Adresse :</strong> {{ $endroit->adresse ?? 'Non spécifiée' }}<br>
            @if($endroit->horaires)
              <strong><i class="bi bi-clock-fill text-warning me-1"></i> Horaires :</strong> {{ $endroit->horaires }}
            @endif
          </p>
        </div>
        <div class="card-footer bg-light text-center">
          <a href="{{ route('endroits.show', $endroit->id) }}" class="btn btn-details btn-sm px-4">
            <i class="bi bi-eye me-1"></i> Détails
          </a>
          @auth
            <div class="mt-2">
              <a href="{{ route('endroits.edit', $endroit->id) }}" class="btn btn-sm btn-warning">✏️ Éditer</a>
              <form action="{{ route('endroits.destroy', $endroit->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression ?')">🗑️</button>
              </form>
            </div>
          @endauth
        </div>
      </div>
    </div>
  @empty
    <div class="alert alert-info w-100 text-center py-4">
      <i class="bi bi-emoji-neutral fs-1 me-2"></i>
      Aucun endroit disponible pour le moment
    </div>
  @endforelse
</div>
@endsection

