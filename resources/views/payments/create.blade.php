{{-- Étend le layout principal --}}
@extends('layouts.app')

@section('content')
<h2>Enregistrer un paiement</h2>

{{-- Formulaire de paiement: enregistre un paiement pour un étudiant --}}
<form action="{{ route('payments.store') }}" method="POST" class="formulaire-carte">
    {{-- Jeton CSRF pour sécuriser la requête POST --}}
    @csrf

    <div class="mb-3">
        <label class="etiquette-formulaire">Prénom de l'étudiant</label>
        {{-- Saisie du prénom de l'étudiant --}}
        <input type="text" name="student_first_name" class="champ-formulaire" required>
    </div>

    <div class="mb-3">
        <label class="etiquette-formulaire">Nom de l'étudiant</label>
        {{-- Saisie du nom de l'étudiant --}}
        <input type="text" name="student_last_name" class="champ-formulaire" required>
    </div>

    <div class="mb-3">
        <label class="etiquette-formulaire">Montant payé (FCFA)</label>
        {{-- Montant payé --}}
        <input type="number" name="amount" class="champ-formulaire" required>
    </div>

    <div class="mb-3">
        <label class="etiquette-formulaire">Méthode de paiement</label>
        {{-- Méthode de paiement (facultative) --}}
        <select name="method" class="champ-formulaire">
            <option value="">-- Choisir --</option>
            <option value="Espèces">Espèces</option>
            <option value="Virement">Virement</option>
            <option value="Chèque">Chèque</option>
        </select>
    </div>

    <button class="bouton bouton-primaire">Enregistrer le paiement</button>
</form>
@endsection