@extends('layouts.app')

@section('title', 'Créer un Match')

@section('content')
<a href="{{ route('games.index') }}" class="btn btn-secondary mb-3">← Retour</a>

<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header bg-danger text-white">
        <h4 class="mb-0">➕ Créer un Match</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('games.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label class="form-label"><strong>Stade *</strong></label>
            <select name="stade_id" class="form-select @error('stade_id') is-invalid @enderror" required>
              <option value="">-- Choisir un stade --</option>
              @foreach(\App\Models\Stade::all() as $stade)
                <option value="{{ $stade->id }}" {{ old('stade_id') == $stade->id ? 'selected' : '' }}>
                  {{ $stade->nom }} ({{ $stade->ville->nom }})
                </option>
              @endforeach
            </select>
            @error('stade_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Équipe 1 *</strong></label>
              <input type="text" name="equipe1" class="form-control @error('equipe1') is-invalid @enderror" 
                     value="{{ old('equipe1') }}" required>
              @error('equipe1') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Équipe 2 *</strong></label>
              <input type="text" name="equipe2" class="form-control @error('equipe2') is-invalid @enderror" 
                     value="{{ old('equipe2') }}" required>
              @error('equipe2') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Date *</strong></label>
              <input type="date" name="date_match" class="form-control @error('date_match') is-invalid @enderror" 
                     value="{{ old('date_match') }}" required>
              @error('date_match') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Heure *</strong></label>
              <input type="time" name="heure_match" class="form-control @error('heure_match') is-invalid @enderror" 
                     value="{{ old('heure_match') }}" required>
              @error('heure_match') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Type de Match</strong></label>
            <select name="type_match" class="form-select @error('type_match') is-invalid @enderror">
              <option value="">-- Choisir un type --</option>
              <option value="Groupe" {{ old('type_match') == 'Groupe' ? 'selected' : '' }}>Groupe</option>
              <option value="Huitièmes" {{ old('type_match') == 'Huitièmes' ? 'selected' : '' }}>Huitièmes</option>
              <option value="Quarts" {{ old('type_match') == 'Quarts' ? 'selected' : '' }}>Quarts</option>
              <option value="Demi-finale" {{ old('type_match') == 'Demi-finale' ? 'selected' : '' }}>Demi-finale</option>
              <option value="Finale" {{ old('type_match') == 'Finale' ? 'selected' : '' }}>Finale</option>
            </select>
            @error('type_match') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <button type="submit" class="btn btn-danger w-100">Créer le Match</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection