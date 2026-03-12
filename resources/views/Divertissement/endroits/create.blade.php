@extends('layouts.app')

@section('title', __('messages.add_place') . ' - ' . __('messages.app_name'))

@section('content')
<a href="{{ route('home') }}" class="btn btn-secondary mb-3">
    {{ __('messages.back_to_guide') }}
</a>

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header bg-success text-white">
        <h4 class="mb-0">➕ {{ __('messages.add_place') }}</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('endroits.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label class="form-label">
              <strong>{{ __('messages.city') }} *</strong>
              <small class="text-muted">({{ __('messages.required_field') }})</small>
            </label>
            <select name="ville_id" class="form-select @error('ville_id') is-invalid @enderror" required>
              <option value="">{{ __('messages.select_city') }}</option>
              @foreach($villes as $ville)
                <option value="{{ $ville->id }}" {{ old('ville_id') == $ville->id ? 'selected' : '' }}>
                  {{ $ville->nom }}
                </option>
              @endforeach
            </select>
            @error('ville_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">
              <strong>{{ __('messages.name') }} *</strong>
            </label>
            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" 
                   value="{{ old('nom') }}" required>
            @error('nom') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">
              <strong>{{ __('messages.type') }} *</strong>
            </label>
            <select name="type" class="form-select @error('type') is-invalid @enderror" required>
              <option value="">{{ __('messages.select_type') }}</option>
              <option value="Monument Historique" {{ old('type') == 'Monument Historique' ? 'selected' : '' }}>{{ __('messages.historical_monument') }}</option>
              <option value="Plage" {{ old('type') == 'Plage' ? 'selected' : '' }}>{{ __('messages.beach') }}</option>
              <option value="Centre Commercial" {{ old('type') == 'Centre Commercial' ? 'selected' : '' }}>{{ __('messages.shopping_center') }}</option>
              <option value="Marché" {{ old('type') == 'Marché' ? 'selected' : '' }}>{{ __('messages.market') }}</option>
              <option value="Lieu Culturel" {{ old('type') == 'Lieu Culturel' ? 'selected' : '' }}>{{ __('messages.cultural_site') }}</option>
              <option value="Nature" {{ old('type') == 'Nature' ? 'selected' : '' }}>{{ __('messages.nature') }}</option>
              <option value="Parc" {{ old('type') == 'Parc' ? 'selected' : '' }}>{{ __('messages.park') }}</option>
              <option value="Musée" {{ old('type') == 'Musée' ? 'selected' : '' }}>{{ __('messages.museum') }}</option>
            </select>
            @error('type') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>{{ __('messages.address') }}</strong></label>
            <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror" 
                   value="{{ old('adresse') }}">
            @error('adresse') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>{{ __('messages.phone') }}</strong></label>
              <input type="tel" name="telephone" class="form-control @error('telephone') is-invalid @enderror" 
                     value="{{ old('telephone') }}">
              @error('telephone') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>{{ __('messages.hours') }}</strong></label>
              <input type="text" name="horaires" class="form-control @error('horaires') is-invalid @enderror" 
                     value="{{ old('horaires') }}" placeholder="{{ __('messages.hours_placeholder') }}">
              @error('horaires') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>{{ __('messages.image_url') }}</strong></label>
            <input type="url" name="image_url" class="form-control @error('image_url') is-invalid @enderror" 
                   value="{{ old('image_url') }}">
            @error('image_url') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>{{ __('messages.description') }}</strong></label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                      rows="4">{{ old('description') }}</textarea>
            @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <button type="submit" class="btn btn-success w-100">
            {{ __('messages.create_place_button') }}
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
