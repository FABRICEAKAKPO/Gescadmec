{{-- Étend le layout principal --}}
@extends('layouts.app')

@section('content')
<h2>Nouvel Étudiant</h2>
{{-- Formulaire d'ajout d'un étudiant: envoie vers la route nommée students.store --}}
<form action="{{ route('students.store') }}" method="POST" class="formulaire-carte">
    {{-- Jeton CSRF obligatoire pour sécuriser les requêtes POST --}}
    @csrf
    <div class="row mb-3">
        <div class="col">
            <label class="etiquette-formulaire">Prénom</label>
            {{-- Champ prénom obligatoire --}}
            <input type="text" name="first_name" class="champ-formulaire" required>
        </div>
        <div class="col">
            <label class="etiquette-formulaire">Nom</label>
            {{-- Champ nom obligatoire --}}
            <input type="text" name="last_name" class="champ-formulaire" required>
        </div>
    </div>
    <div class="mb-3">
        <label class="etiquette-formulaire">Email</label>
        {{-- Email facultatif --}}
        <input type="email" name="email" class="champ-formulaire">
    </div>
    <div class="mb-3">
        <label class="etiquette-formulaire">Téléphone</label>
        {{-- Téléphone facultatif --}}
        <input type="text" name="phone" class="champ-formulaire">
    </div>
    <div class="mb-3">
        <label class="etiquette-formulaire">Adresse</label>
        {{-- Adresse facultative --}}
        <textarea name="address" class="champ-formulaire"></textarea>
    </div>
    <button class="bouton bouton-primaire">Enregistrer</button>
</form>
@endsection