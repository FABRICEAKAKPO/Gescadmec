{{-- Étend le layout principal --}}
@extends('layouts.app')

@section('content')
<h2>Nouvelle Inscription</h2>

{{-- Formulaire d'inscription: relie un étudiant à un cours avec niveau/dates/montant --}}
<form action="{{ route('enrollments.store') }}" method="POST" class="card p-4">
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
        <label>Email de l'étudiant</label>
        {{-- Saisie de l'email de l'étudiant --}}
        <input type="email" name="student_email" class="form-control">
    </div>

    <div class="mb-3">
        <label>Téléphone de l'étudiant</label>
        {{-- Saisie du téléphone de l'étudiant --}}
        <input type="text" name="student_phone" class="form-control">
    </div>

    <div class="mb-3">
        <label>Adresse de l'étudiant</label>
        {{-- Saisie de l'adresse de l'étudiant --}}
        <textarea name="student_address" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Cours</label>
        {{-- Sélection du cours --}}
        <select name="course_id" class="form-select" required>
            <option value="">-- Choisir un cours --</option>
            <option value="1">Anglais</option>
            <option value="2">Français</option>
            <option value="3">Espagnol</option>
            <option value="4">Allemand</option>
            <option value="5">Italien</option>
            <option value="6">Portugais</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Niveau</label>
        {{-- Choix du niveau (liste fixe) --}}
        <select name="level" class="form-select" id="level" required>
    <option value="">-- Choisir un niveau --</option>
    @foreach(['A1','A2','B1','B2','C1','C2'] as $level)
        <option value="{{ $level }}">{{ $level }}</option>
    @endforeach
</select>
    </div>

    <div class="mb-3">
        <label>Statut</label>
        {{-- Choix du statut --}}
        <select name="status" class="form-select" required>
            <option value="active">Actif</option>
            <option value="inactive">Inactif</option>
            <option value="completed">Terminé</option>
            <option value="cancelled">Annulé</option>
        </select>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label>Date début</label>
            {{-- Date de début de la formation --}}
            <input type="date" name="date_debut" class="form-control" required>
        </div>
        <div class="col">
            <label>Date fin</label>
            {{-- Date de fin de la formation --}}
            <input type="date" name="date_fin" class="form-control" required>
        </div>
    </div>

    <div class="mb-3">
        <label>Montant total (FCFA)</label>
        {{-- Montant total de l'inscription --}}
        <input type="number" name="total_amount" id="total_amount" class="form-control" required readonly>
    </div>

    <button class="btn btn-primary">Enregistrer</button>
</form>

<script>
    // Tableau de correspondance niveau -> prix
    const levelPrices = {
        'A1': 75000,
        'A2': 90000,
        'B1': 110000,
        'B2': 125000,
        'C1': 160000,
        'C2': 190000
    };

    // Écouter les changements de niveau
    document.getElementById('level').addEventListener('change', function() {
        const selectedLevel = this.value;
        const amountField = document.getElementById('total_amount');
        
        if (selectedLevel && levelPrices[selectedLevel]) {
            amountField.value = levelPrices[selectedLevel];
        } else {
            amountField.value = '';
        }
    });
</script>
@endsection