@extends('layouts.app')

@section('title', 'Éditer - ' . $restaurant->nom)

@section('content')
<a href="{{ route('restaurants.index') }}" class="btn btn-secondary mb-3">← Retour</a>

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header bg-warning text-white">
        <h4 class="mb-0">✏️ Éditer le Restaurant</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('restaurants.update', $restaurant->id) }}" method="POST">
          @csrf @method('PUT')

          <div class="mb-3">
            <label class="form-label"><strong>Ville *</strong></label>
            <select name="ville_id" class="form-select @error('ville_id') is-invalid @enderror" required>
              <option value="">-- Choisir une ville --</option>
              @foreach(\App\Models\Ville::all() as $ville)
                <option value="{{ $ville->id }}" {{ old('ville_id', $restaurant->ville_id) == $ville->id ? 'selected' : '' }}>
                  {{ $ville->nom }}
                </option>
              @endforeach
            </select>
            @error('ville_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Nom *</strong></label>
            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" 
                   value="{{ old('nom', $restaurant->nom) }}" required>
            @error('nom') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Type de cuisine *</strong></label>
            <input type="text" name="type_cuisine" class="form-control @error('type_cuisine') is-invalid @enderror" 
                   value="{{ old('type_cuisine', $restaurant->type_cuisine) }}" placeholder="Ex: Marocain" required>
            @error('type_cuisine') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Prix moyen (MAD) *</strong></label>
            <input type="number" name="prix_moyen" class="form-control @error('prix_moyen') is-invalid @enderror" 
                   value="{{ old('prix_moyen', $restaurant->prix_moyen) }}" step="0.01" required>
            @error('prix_moyen') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Adresse</strong></label>
            <textarea name="adresse" class="form-control @error('adresse') is-invalid @enderror" 
                      rows="2">{{ old('adresse', $restaurant->adresse) }}</textarea>
            @error('adresse') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Téléphone</strong></label>
              <input type="tel" name="telephone" class="form-control @error('telephone') is-invalid @enderror" 
                     value="{{ old('telephone', $restaurant->telephone) }}">
              @error('telephone') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Email</strong></label>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                     value="{{ old('email', $restaurant->email) }}">
              @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Horaires</strong></label>
            <input type="text" name="horaires" class="form-control @error('horaires') is-invalid @enderror" 
                   value="{{ old('horaires', $restaurant->horaires) }}" placeholder="Ex: 11h30 - 23h00">
            @error('horaires') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>URL Image</strong></label>
            <input type="url" name="image_url" class="form-control @error('image_url') is-invalid @enderror" 
                   value="{{ old('image_url', $restaurant->image_url) }}">
            @error('image_url') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Description</strong></label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                      rows="4">{{ old('description', $restaurant->description) }}</textarea>
            @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning flex-grow-1">Mettre à jour</button>
            <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer ce restaurant ?')">Supprimer</button>
            </form>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection