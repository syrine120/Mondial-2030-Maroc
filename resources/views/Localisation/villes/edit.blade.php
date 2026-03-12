@extends('layouts.app')

@section('title', 'Éditer - ' . $ville->nom)

@section('content')
<a href="{{ route('villes.index') }}" class="btn btn-secondary mb-3">← Retour</a>

<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header bg-warning text-white">
        <h4 class="mb-0">✏️ Éditer la Ville</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('villes.update', $ville->id) }}" method="POST">
          @csrf @method('PUT')

          <div class="mb-3">
            <label class="form-label"><strong>Nom *</strong></label>
            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" 
                   value="{{ old('nom', $ville->nom) }}" required>
            @error('nom') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Description</strong></label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                      rows="4">{{ old('description', $ville->description) }}</textarea>
            @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>URL Image</strong></label>
            <input type="url" name="image_url" class="form-control @error('image_url') is-invalid @enderror" 
                   value="{{ old('image_url', $ville->image_url) }}">
            @error('image_url') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Latitude</strong></label>
              <input type="number" name="latitude" class="form-control" step="0.0001" 
                     value="{{ old('latitude', $ville->latitude) }}">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Longitude</strong></label>
              <input type="number" name="longitude" class="form-control" step="0.0001" 
                     value="{{ old('longitude', $ville->longitude) }}">
            </div>
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning flex-grow-1">Mettre à jour</button>
            <form action="{{ route('villes.destroy', $ville->id) }}" method="POST" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer cette ville ?')">Supprimer</button>
            </form>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection