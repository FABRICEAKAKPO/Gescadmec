{{-- Étend le layout principal --}}
@extends('layouts.app')

@section('content')
<h2>Nouvel Étudiant</h2>
{{-- Formulaire d'ajout d'un étudiant: envoie vers la route nommée students.store --}}
<form action="{{ route('students.store') }}" method="POST" class="card p-4">
    {{-- Jeton CSRF obligatoire pour sécuriser les requêtes POST --}}
    @csrf
    <div class="row mb-3">
        <div class="col">
            <label>Prénom</label>
            {{-- Champ prénom obligatoire --}}
            <input type="text" name="first_name" class="form-control" required>
        </div>
        <div class="col">
            <label>Nom</label>
            {{-- Champ nom obligatoire --}}
            <input type="text" name="last_name" class="form-control" required>
        </div>
    </div>
    <div class="mb-3">
        <label>Email</label>
        {{-- Email facultatif --}}
        <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label>Téléphone</label>
        {{-- Téléphone facultatif --}}
        <input type="text" name="phone" class="form-control">
    </div>
    <div class="mb-3">
        <label>Adresse</label>
        {{-- Adresse facultative --}}
        <textarea name="address" class="form-control"></textarea>
    </div>
    <button class="btn btn-primary">Enregistrer</button>
</form>
@endsection
