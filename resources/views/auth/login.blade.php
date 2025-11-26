{{-- Étend le layout d'authentification --}}
@extends('layouts.auth')

{{-- Titre de la page --}}
@section('title', 'Connexion')

{{-- Contenu principal: formulaire de connexion sécurisé --}}
@section('content')
<div class="card auth-card">
    <div class="card-body p-4">
        <h3 class="card-title text-center mb-4">Connexion</h3>
        
        <form method="POST" action="{{ route('login') }}">
            {{-- Jeton CSRF obligatoire pour sécuriser le POST --}}
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Adresse Email</label>
                {{-- Champ email avec gestion des erreurs via @error --}}
                {{-- Champ email avec gestion des erreurs via @error --}}
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                {{-- Mot de passe avec validation et message d’erreur --}}
                {{-- Mot de passe avec validation et message d’erreur --}}
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Se souvenir de moi
                </label>
            </div>

            {{-- Bouton de soumission --}}
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    Se connecter
                </button>
            </div>

            {{-- Lien vers la demande de réinitialisation de mot de passe --}}
            <div class="text-center mt-3">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-muted small">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>
        </form>
    </div>
    <div class="card-footer bg-light text-center py-3">
        <span class="text-muted">Pas encore de compte ?</span>
        <a href="{{ route('register') }}" class="text-decoration-none">S'inscrire</a>
    </div>
</div>
@endsection
