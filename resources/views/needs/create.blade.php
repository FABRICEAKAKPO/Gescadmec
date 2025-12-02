{{-- Étend le layout principal --}}
@extends('layouts.app')

@section('content')
<h2>Ajouter un nouveau besoin</h2>

{{-- Formulaire de besoin: relie un besoin à un étudiant --}}
<form action="{{ route('needs.store') }}" method="POST" class="formulaire-carte">
    {{-- Jeton CSRF pour sécuriser la requête POST --}}
    @csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="etiquette-formulaire">Prénom de l'étudiant</label>
            <input type="text" name="student_first_name" class="champ-formulaire" required>
        </div>
        <div class="col-md-6">
            <label class="etiquette-formulaire">Nom de l'étudiant</label>
            <input type="text" name="student_last_name" class="champ-formulaire" required>
        </div>
    </div>
    <div class="mb-3">
        <label class="etiquette-formulaire">Type de besoin</label>
        {{-- Type facultatif (ex: matériel, horaire) --}}
        <input type="text" name="type" class="champ-formulaire" placeholder="Ex: matériel, horaire, soutien..." >
    </div>
    <div class="mb-3">
        <label class="etiquette-formulaire">Statut</label>
        {{-- Statut du besoin --}}
        <select name="status" class="champ-formulaire">
            <option value="en attente" selected>En attente</option>
            <option value="en cours">En cours</option>
            <option value="résolu">Résolu</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="etiquette-formulaire">Description</label>
        {{-- Description obligatoire du besoin --}}
        <textarea name="description" class="champ-formulaire" rows="4" placeholder="Décrivez en détail le besoin de l'étudiant..." required></textarea>
    </div>
    <button class="bouton bouton-primaire">Enregistrer</button>
    <a href="{{ route('needs.index') }}" class="bouton bouton-secondaire">Annuler</a>
</form>
@endsection