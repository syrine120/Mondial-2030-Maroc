@extends('layouts.app')

@section('title', 'Ajouter une Pharmacie')

@section('content')
<a href="{{ route('pharmacies.index') }}" class="btn btn-secondary mb-3">← Retour</a>

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header bg-success text-white">
        <h4 class="mb-0">➕ Ajouter une Pharmacie</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('pharmacies.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label class="form-label"><strong>Ville *</strong></label>
            <select name="ville_id" class="form-select @error('ville_id') is-invalid @enderror" required>
              <option value="">-- Choisir une ville --</option>
              @foreach($villes as $ville)
                <option value="{{ $ville->id }}" {{ old('ville_id') == $ville->id ? 'selected' : '' }}>
                  {{ $ville->nom }}
                </option>
              @endforeach
            </select>
            @error('ville_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Nom *</strong></label>
            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" 
                   value="{{ old('nom') }}" required>
            @error('nom') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Adresse</strong></label>
            <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror" 
                   value="{{ old('adresse') }}">
            @error('adresse') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Téléphone</strong></label>
            <input type="tel" name="telephone" class="form-control @error('telephone') is-invalid @enderror" 
                   value="{{ old('telephone') }}">
            @error('telephone') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Latitude</strong></label>
              <input type="number" name="latitude" class="form-control @error('latitude') is-invalid @enderror" 
                     step="0.000001" value="{{ old('latitude') }}">
              @error('latitude') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Longitude</strong></label>
              <input type="number" name="longitude" class="form-control @error('longitude') is-invalid @enderror" 
                     step="0.000001" value="{{ old('longitude') }}">
              @error('longitude') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>URL Image</strong></label>
            <input type="url" name="image_url" class="form-control @error('image_url') is-invalid @enderror" 
                   value="{{ old('image_url') }}">
            @error('image_url') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Description</strong></label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                      rows="4">{{ old('description') }}</textarea>
            @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <button type="submit" class="btn btn-success w-100">Créer la Pharmacie</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection