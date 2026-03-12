@extends('layouts.app')

@section('title', 'Connexion - Mondial 2030')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-danger text-white text-center py-4">
                    <h2 class="mb-0">Connexion 🔐</h2>
                </div>
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold text-secondary">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold text-secondary">Mot de passe</label>
                            <input type="password" name="password" id="password"
                                class="form-control form-control-lg rounded-3 @error('password') is-invalid @enderror"
                                required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger btn-lg rounded-3 fw-bold py-3">Se connecter</button>
                        </div>

                        <div class="text-center mt-4 text-secondary">
                            Pas encore de compte ? <a href="{{ route('register') }}"
                                class="text-danger fw-bold text-decoration-none">S'inscrire</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection