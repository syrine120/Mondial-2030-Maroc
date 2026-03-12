@extends('layouts.app')

@section('title', 'Éditer - ' . $hotel->nom)

@section('content')
<a href="{{ route('hotels.index') }}" class="btn btn-secondary mb-3">← Retour</a>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-warning text-white">
                <h4 class="mb-0">✏️ Éditer l'Hôtel</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('hotels.update', $hotel->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label"><strong>Nom *</strong></label>
                        <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" 
                               value="{{ old('nom', $hotel->nom) }}" required>
                        @error('nom') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Ville *</strong></label>
                        <select name="ville_id" class="form-control @error('ville_id') is-invalid @enderror" required>
                            <option value="">Sélectionner une ville</option>
                            @foreach($villes as $ville)
                                <option value="{{ $ville->id }}" {{ old('ville_id', $hotel->ville_id) == $ville->id ? 'selected' : '' }}>
                                    {{ $ville->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('ville_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Étoiles</strong></label>
                        <input type="number" name="etoiles" class="form-control @error('etoiles') is-invalid @enderror" 
                               min="1" max="5" value="{{ old('etoiles', $hotel->etoiles) }}">
                        @error('etoiles') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Prix moyen par nuit (MAD)</strong></label>
                        <input type="number" name="prix_nuit" class="form-control @error('prix_nuit') is-invalid @enderror" 
                               step="0.01" value="{{ old('prix_nuit', $hotel->prix_nuit) }}">
                        @error('prix_nuit') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Téléphone</strong></label>
                        <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" 
                               value="{{ old('telephone', $hotel->telephone) }}">
                        @error('telephone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Adresse</strong></label>
                        <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror" 
                               value="{{ old('adresse', $hotel->adresse) }}">
                        @error('adresse') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Description</strong></label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                  rows="4">{{ old('description', $hotel->description) }}</textarea>
                        @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>URL Image</strong></label>
                        <input type="url" name="image_url" class="form-control @error('image_url') is-invalid @enderror" 
                               value="{{ old('image_url', $hotel->image_url) }}">
                        @error('image_url') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning flex-grow-1">Mettre à jour</button>

                        <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer cet hôtel ?')">
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