{{-- Étend le layout principal --}}
@extends('layouts.app')

@section('content')
<h2>Modifier l'Étudiant</h2>
{{-- Formulaire de modification d'un étudiant: envoie vers la route nommée students.update --}}
<form action="{{ route('students.update', $student) }}" method="POST" class="formulaire-carte">
    {{-- Jeton CSRF obligatoire pour sécuriser les requêtes POST --}}
    @csrf
    {{-- Méthode PUT pour la mise à jour --}}
    @method('PUT')
    <div class="row mb-3">
        <div class="col">
            <label class="etiquette-formulaire">Prénom</label>
            {{-- Champ prénom obligatoire --}}
            <input type="text" name="first_name" class="champ-formulaire" value="{{ old('first_name', $student->first_name) }}" required>
        </div>
        <div class="col">
            <label class="etiquette-formulaire">Nom</label>
            {{-- Champ nom obligatoire --}}
            <input type="text" name="last_name" class="champ-formulaire" value="{{ old('last_name', $student->last_name) }}" required>
        </div>
    </div>
    <div class="mb-3">
        <label class="etiquette-formulaire">Email</label>
        {{-- Email facultatif --}}
        <input type="email" name="email" class="champ-formulaire" value="{{ old('email', $student->email) }}">
    </div>
    <div class="mb-3">
        <label class="etiquette-formulaire">Téléphone</label>
        {{-- Téléphone facultatif --}}
        <input type="text" name="phone" class="champ-formulaire" value="{{ old('phone', $student->phone) }}">
    </div>
    <div class="mb-3">
        <label class="etiquette-formulaire">Adresse</label>
        {{-- Adresse facultative --}}
        <textarea name="address" class="champ-formulaire">{{ old('address', $student->address) }}</textarea>
    </div>
    <button class="bouton bouton-primaire">Mettre à jour</button>
</form>
@endsection