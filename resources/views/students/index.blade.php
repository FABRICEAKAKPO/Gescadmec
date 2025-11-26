{{-- Étend le layout principal pour réutiliser l'entête/side-menu --}}
@extends('layouts.app')

{{-- Début de la section de contenu injectée dans layouts.app --}}
@section('content')
<h2>Liste des Étudiants</h2>

<div class="alert alert-info mb-3">Total étudiants enregistrés : <strong>{{ $totalStudents }}</strong></div>

{{-- Lien vers le formulaire d'ajout d'un étudiant --}}
<a href="{{ route('students.create') }}" class="btn btn-success mb-3">+ Ajouter un étudiant</a>

{{-- Formulaire GET: garde les filtres dans l'URL et permet pagination avec appends() --}}
<form method="GET" action="{{ route('students.index') }}" class="row g-2 mb-3">
    <div class="col-md-6">
        <label class="form-label">Recherche</label>
        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Nom, email, téléphone" />
    </div>
    <div class="col-12">
        <button class="btn btn-primary">Filtrer</button>
        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
    </div>
</form>
<table class="table table-bordered bg-white">
    <thead>
        <tr>
            <th>Nom complet</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Adresse</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
{{-- Boucle sur les étudiants; @forelse gère aussi le cas vide --}}
        @forelse($students as $student)
        <tr class="{{ $loop->index >= 5 ? 'd-none js-stu-row' : '' }}">
            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->phone }}</td>
            <td>{{ $student->address }}</td>
            <td>
                <a href="{{ route('students.edit', $student) }}" class="btn btn-primary btn-sm" style="display: inline-block; margin-right: 5px;">Modifier</a>
                <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ? Cette action est irréversible.')" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center text-muted">Aucun étudiant enregistré.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@if($students->count() > 5)
    <button class="btn btn-sm btn-outline-primary" id="toggle-stu">Voir plus</button>
@endif
@endsection