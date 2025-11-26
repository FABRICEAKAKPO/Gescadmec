{{-- Étend le layout d'authentification --}}
@extends('layouts.auth')

{{-- Titre de la page --}}
@section('title', 'Inscription')

{{-- Formulaire d'inscription sécurisé --}}
@section('content')
<div class="card auth-card">
    <div class="card-body p-4">
        <h3 class="card-title text-center mb-4">Créer un compte</h3>
        
        <form method="POST" action="{{ route('register') }}">
            {{-- Jeton CSRF obligatoire pour sécuriser le POST --}}
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nom complet</label>
                {{-- Champ nom complet --}}
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Adresse Email</label>
                {{-- Email valide, unique --}}
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                {{-- Mot de passe (min 8), confirmé --}}
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password-confirm" class="form-label">Confirmer le mot de passe</label>
                {{-- Confirmation du mot de passe --}}
                <input id="password-confirm" type="password" class="form-control" 
                       name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    S'inscrire
                </button>
            </div>
        </form>
    </div>
    <div class="card-footer bg-light text-center py-3">
        <span class="text-muted">Déjà un compte ?</span>
        <a href="{{ route('login') }}" class="text-decoration-none">Se connecter</a>
    </div>
</div>
@endsection
