{{-- Étend le layout principal --}}
@extends('layouts.app')

@section('content')
<h2>Modifier l'Étudiant</h2>
{{-- Formulaire de modification d'un étudiant: envoie vers la route nommée students.update --}}
<form action="{{ route('students.update', $student) }}" method="POST" class="card p-4">
    {{-- Jeton CSRF obligatoire pour sécuriser les requêtes POST --}}
    @csrf
    {{-- Méthode PUT pour la mise à jour --}}
    @method('PUT')
    <div class="row mb-3">
        <div class="col">
            <label>Prénom</label>
            {{-- Champ prénom obligatoire --}}
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $student->first_name) }}" required>
        </div>
        <div class="col">
            <label>Nom</label>
            {{-- Champ nom obligatoire --}}
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $student->last_name) }}" required>
        </div>
    </div>
    <div class="mb-3">
        <label>Email</label>
        {{-- Email facultatif --}}
        <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}">
    </div>
    <div class="mb-3">
        <label>Téléphone</label>
        {{-- Téléphone facultatif --}}
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $student->phone) }}">
    </div>
    <div class="mb-3">
        <label>Adresse</label>
        {{-- Adresse facultative --}}
        <textarea name="address" class="form-control">{{ old('address', $student->address) }}</textarea>
    </div>
    <button class="btn btn-primary">Mettre à jour</button>
</form>
@endsection