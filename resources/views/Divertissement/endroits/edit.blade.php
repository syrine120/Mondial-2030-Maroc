@extends('layouts.app')

@section('title', 'Éditer - ' . $endroit->nom)

@section('content')
<a href="{{ route('endroits.index') }}" class="btn btn-secondary mb-3">← Retour</a>

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header bg-warning text-white">
        <h4 class="mb-0">✏️ Éditer l'Endroit</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('endroits.update', $endroit->id) }}" method="POST">
          @csrf @method('PUT')

          <div class="mb-3">
            <label class="form-label"><strong>Ville *</strong></label>
            <select name="ville_id" class="form-select @error('ville_id') is-invalid @enderror" required>
              @foreach($villes as $ville)
                <option value="{{ $ville->id }}" {{ old('ville_id', $endroit->ville_id) == $ville->id ? 'selected' : '' }}>
                  {{ $ville->nom }}
                </option>
              @endforeach
            </select>
            @error('ville_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Nom *</strong></label>
            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" 
                   value="{{ old('nom', $endroit->nom) }}" required>
            @error('nom') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Type *</strong></label>
            <select name="type" class="form-select @error('type') is-invalid @enderror" required>
              <option value="Monument Historique" {{ old('type', $endroit->type) == 'Monument Historique' ? 'selected' : '' }}>Monument Historique</option>
              <option value="Plage" {{ old('type', $endroit->type) == 'Plage' ? 'selected' : '' }}>Plage</option>
              <option value="Centre Commercial" {{ old('type', $endroit->type) == 'Centre Commercial' ? 'selected' : '' }}>Centre Commercial</option>
              <option value="Marché" {{ old('type', $endroit->type) == 'Marché' ? 'selected' : '' }}>Marché</option>
              <option value="Lieu Culturel" {{ old('type', $endroit->type) == 'Lieu Culturel' ? 'selected' : '' }}>Lieu Culturel</option>
              <option value="Nature" {{ old('type', $endroit->type) == 'Nature' ? 'selected' : '' }}>Nature</option>
              <option value="Parc" {{ old('type', $endroit->type) == 'Parc' ? 'selected' : '' }}>Parc</option>
              <option value="Musée" {{ old('type', $endroit->type) == 'Musée' ? 'selected' : '' }}>Musée</option>
            </select>
            @error('type') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Adresse</strong></label>
            <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror" 
                   value="{{ old('adresse', $endroit->adresse) }}">
            @error('adresse') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Téléphone</strong></label>
              <input type="tel" name="telephone" class="form-control @error('telephone') is-invalid @enderror" 
                     value="{{ old('telephone', $endroit->telephone) }}">
              @error('telephone') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Horaires</strong></label>
              <input type="text" name="horaires" class="form-control @error('horaires') is-invalid @enderror" 
                     value="{{ old('horaires', $endroit->horaires) }}">
              @error('horaires') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>URL Image</strong></label>
            <input type="url" name="image_url" class="form-control @error('image_url') is-invalid @enderror" 
                   value="{{ old('image_url', $endroit->image_url) }}">
            @error('image_url') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Description</strong></label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                      rows="4">{{ old('description', $endroit->description) }}</textarea>
            @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning flex-grow-1">Mettre à jour</button>

            <form action="{{ route('endroits.destroy', $endroit->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer cet endroit ?')">
                Supprimer
              </button>
            </form>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection