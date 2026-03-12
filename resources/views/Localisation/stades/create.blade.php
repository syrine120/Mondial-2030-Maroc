@extends('layouts.app')

@section('title', 'Ajouter un Stade')

@section('content')
<a href="{{ route('stades.index') }}" class="btn btn-secondary mb-3">← Retour</a>

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header bg-success text-white">
        <h4 class="mb-0">➕ Ajouter un Stade</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('stades.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label class="form-label"><strong>Nom *</strong></label>
            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" 
                   value="{{ old('nom') }}" required>
            @error('nom') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

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
            <label class="form-label"><strong>Capacité (places) *</strong></label>
            <input type="number" name="capacite" class="form-control @error('capacite') is-invalid @enderror" 
                   value="{{ old('capacite') }}" required>
            @error('capacite') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Adresse</strong></label>
            <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror" 
                   value="{{ old('adresse') }}">
            @error('adresse') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>URL Image</strong></label>
            <input type="url" name="image_url" class="form-control @error('image_url') is-invalid @enderror" 
                   value="{{ old('image_url') }}">
            @error('image_url') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <button type="submit" class="btn btn-success w-100">Créer le Stade</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection