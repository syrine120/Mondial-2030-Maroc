@extends('layouts.app')

@section('title', 'Convertisseur de Monnaie')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-header bg-success text-white text-center">
        <h4 class="mb-0">💱 Convertisseur de Monnaie</h4>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('convertisseur.convert') }}">
          @csrf
          
          <div class="mb-3">
            <label class="form-label"><strong>Montant</strong></label>
            <input type="number" name="montant" class="form-control" step="0.01" 
                   value="{{ old('montant', $montant ?? '') }}" required autofocus>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>De</strong></label>
              <select name="devise_source" class="form-select" required>
                <option value="MAD" {{ (old('devise_source') ?? $devise_source ?? '') === 'MAD' ? 'selected' : '' }}>🇲🇦 MAD (Dirham)</option>
                <option value="EUR" {{ (old('devise_source') ?? $devise_source ?? '') === 'EUR' ? 'selected' : '' }}>🇪🇺 EUR (Euro)</option>
                <option value="USD" {{ (old('devise_source') ?? $devise_source ?? '') === 'USD' ? 'selected' : '' }}>🇺🇸 USD (Dollar)</option>
                <option value="GBP" {{ (old('devise_source') ?? $devise_source ?? '') === 'GBP' ? 'selected' : '' }}>🇬🇧 GBP (Livre)</option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label"><strong>Vers</strong></label>
              <select name="devise_cible" class="form-select" required>
                <option value="MAD" {{ (old('devise_cible') ?? $devise_cible ?? '') === 'MAD' ? 'selected' : '' }}>🇲🇦 MAD (Dirham)</option>
                <option value="EUR" {{ (old('devise_cible') ?? $devise_cible ?? '') === 'EUR' ? 'selected' : '' }}>🇪🇺 EUR (Euro)</option>
                <option value="USD" {{ (old('devise_cible') ?? $devise_cible ?? '') === 'USD' ? 'selected' : '' }}>🇺🇸 USD (Dollar)</option>
                <option value="GBP" {{ (old('devise_cible') ?? $devise_cible ?? '') === 'GBP' ? 'selected' : '' }}>🇬🇧 GBP (Livre)</option>
              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-success w-100 btn-lg">🔄 Convertir</button>
        </form>

        @if(session('error'))
          <div class="alert alert-danger mt-4">
            ❌ {{ session('error') }}
          </div>
        @endif

        @if(isset($resultat))
          <div class="alert alert-success mt-4">
            <h5>✅ Résultat :</h5>
            <h4 class="mb-0"><strong>{{ number_format($montant, 2, ',', ' ') }} {{ $devise_source }} = {{ number_format($resultat, 2, ',', ' ') }} {{ $devise_cible }}</strong></h4>
            <small class="text-muted">Taux : 1 {{ $devise_source }} = {{ number_format($taux, 4, ',', ' ') }} {{ $devise_cible }}</small>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection