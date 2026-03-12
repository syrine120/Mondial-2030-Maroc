@extends('layouts.app')

@section('title', 'Éditer - ' . $airbnb->nom)

@section('content')
<a href="{{ route('airbnbs.index') }}" class="btn btn-secondary mb-3">← Retour</a>

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header bg-warning text-white">
        <h4 class="mb-0">✏️ Éditer l'Airbnb</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('airbnbs.update', $airbnb->id) }}" method="POST">
          @csrf @method('PUT')

          <div class="mb-3">
            <label class="form-label"><strong>Ville *</strong></label>
            <select name="ville_id" class="form-select @error('ville_id') is-invalid @enderror" required>
              <option value="">-- Choisir une ville --</option>
              @foreach(\App\Models\Ville::all() as $ville)
                <option value="{{ $ville->id }}" {{ old('ville_id', $airbnb->ville_id) == $ville->id ? 'selected' : '' }}>
                  {{ $ville->nom }}
                </option>
              @endforeach
            </select>
            @error('ville_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Nom *</strong></label>
            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" 
                   value="{{ old('nom', $airbnb->nom) }}" required>
            @error('nom') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Chambres *</strong></label>
              <input type="number" name="chambres" class="form-control @error('chambres') is-invalid @enderror" 
                     value="{{ old('chambres', $airbnb->chambres) }}" required>
              @error('chambres') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Capacité (personnes) *</strong></label>
              <input type="number" name="capacite" class="form-control @error('capacite') is-invalid @enderror" 
                     value="{{ old('capacite', $airbnb->capacite) }}" required>
              @error('capacite') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Prix par nuit (MAD) *</strong></label>
              <input type="number" name="prix_nuit" class="form-control @error('prix_nuit') is-invalid @enderror" 
                     value="{{ old('prix_nuit', $airbnb->prix_nuit) }}" step="0.01" required>
              @error('prix_nuit') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Propriétaire *</strong></label>
              <input type="text" name="proprietaire" class="form-control @error('proprietaire') is-invalid @enderror" 
                     value="{{ old('proprietaire', $airbnb->proprietaire) }}" required>
              @error('proprietaire') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Adresse</strong></label>
            <textarea name="adresse" class="form-control @error('adresse') is-invalid @enderror" 
                      rows="2">{{ old('adresse', $airbnb->adresse) }}</textarea>
            @error('adresse') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Téléphone</strong></label>
              <input type="tel" name="telephone" class="form-control @error('telephone') is-invalid @enderror" 
                     value="{{ old('telephone', $airbnb->telephone) }}">
              @error('telephone') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Email</strong></label>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                     value="{{ old('email', $airbnb->email) }}">
              @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>URL Image</strong></label>
            <input type="url" name="image_url" class="form-control @error('image_url') is-invalid @enderror" 
                   value="{{ old('image_url', $airbnb->image_url) }}">
            @error('image_url') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Description</strong></label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                      rows="4">{{ old('description', $airbnb->description) }}</textarea>
            @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning flex-grow-1">Mettre à jour</button>
            <form action="{{ route('airbnbs.destroy', $airbnb->id) }}" method="POST" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer cet Airbnb ?')">Supprimer</button>
            </form>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection