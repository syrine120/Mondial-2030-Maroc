@extends('layouts.app')

@section('title', 'Inscription - Mondial 2030')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-success text-white text-center py-4">
                    <h2 class="mb-0">Inscription ⚽</h2>
                    <p class="mb-0">Rejoignez-nous pour ne rien rater !</p>
                </div>
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label fw-bold text-secondary">Nom COMPLET</label>
                            <input type="text" name="nom" id="nom"
                                class="form-control form-control-lg rounded-3 @error('nom') is-invalid @enderror"
                                value="{{ old('nom') }}" required autofocus>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold text-secondary">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold text-secondary">Mot de passe</label>
                            <input type="password" name="password" id="password"
                                class="form-control form-control-lg rounded-3 @error('password') is-invalid @enderror"
                                required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-bold text-secondary">Confirmer le mot de
                                passe</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control form-control-lg rounded-3" required>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="newsletter" id="newsletter" checked>
                            <label class="form-check-label text-secondary" for="newsletter">
                                Je souhaite recevoir des newsletters sur l'histoire du Maroc et les matchs.
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg rounded-3 fw-bold py-3">Créer mon
                                compte</button>
                        </div>

                        <div class="text-center mt-4 text-secondary">
                            Déjà un compte ? <a href="{{ route('login') }}"
                                class="text-success fw-bold text-decoration-none">Se connecter</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection