{{-- Étend le layout principal --}}
@extends('layouts.app')

@section('content')
<h2>Enregistrer un paiement</h2>

{{-- Formulaire de paiement: enregistre un paiement pour un étudiant --}}
<form action="{{ route('payments.store') }}" method="POST" class="card p-4">
    {{-- Jeton CSRF pour sécuriser la requête POST --}}
    @csrf

    <div class="mb-3">
        <label>Prénom de l'étudiant</label>
        {{-- Saisie du prénom de l'étudiant --}}
        <input type="text" name="student_first_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Nom de l'étudiant</label>
        {{-- Saisie du nom de l'étudiant --}}
        <input type="text" name="student_last_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Montant payé (FCFA)</label>
        {{-- Montant payé --}}
        <input type="number" name="amount" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Méthode de paiement</label>
        {{-- Méthode de paiement (facultative) --}}
        <select name="method" class="form-select">
            <option value="">-- Choisir --</option>
            <option value="Espèces">Espèces</option>
            <option value="Virement">Virement</option>
            <option value="Chèque">Chèque</option>
        </select>
    </div>

    <button class="btn btn-primary">Enregistrer le paiement</button>
</form>
@endsection