{{-- Étend le layout principal --}}
@extends('layouts.app')

@section('content')
<h2>Modifier un besoin</h2>

{{-- Formulaire de besoin: modifie un besoin existant --}}
<form action="{{ route('needs.update', $need) }}" method="POST" class="formulaire-carte">
    {{-- Jeton CSRF pour sécuriser la requête POST --}}
    @csrf
    @method('PUT')
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="etiquette-formulaire">Prénom de l'étudiant</label>
            <input type="text" name="student_first_name" class="champ-formulaire" value="{{ old('student_first_name', $need->student->first_name) }}" required>
        </div>
        <div class="col-md-6">
            <label class="etiquette-formulaire">Nom de l'étudiant</label>
            <input type="text" name="student_last_name" class="champ-formulaire" value="{{ old('student_last_name', $need->student->last_name) }}" required>
        </div>
    </div>
    <div class="mb-3">
        <label class="etiquette-formulaire">Type de besoin</label>
        {{-- Type facultatif (ex: matériel, horaire) --}}
        <input type="text" name="type" class="champ-formulaire" value="{{ old('type', $need->type) }}" placeholder="Ex: matériel, horaire..." >
    </div>
    <div class="mb-3">
        <label class="etiquette-formulaire">Statut</label>
        {{-- Statut du besoin --}}
        <select name="status" class="champ-formulaire">
            <option value="en attente" {{ $need->status == 'en attente' ? 'selected' : '' }}>En attente</option>
            <option value="en cours" {{ $need->status == 'en cours' ? 'selected' : '' }}>En cours</option>
            <option value="résolu" {{ $need->status == 'résolu' ? 'selected' : '' }}>Résolu</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="etiquette-formulaire">Description</label>
        {{-- Description obligatoire du besoin --}}
        <textarea name="description" class="champ-formulaire" rows="4" required>{{ old('description', $need->description) }}</textarea>
    </div>
    <button class="bouton bouton-primaire">Mettre à jour</button>
    <a href="{{ route('needs.index') }}" class="bouton bouton-secondaire">Annuler</a>
</form>
@endsection