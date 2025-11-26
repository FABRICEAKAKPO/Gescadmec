{{-- Étend le layout principal --}}
@extends('layouts.app')

@section('content')
<h2>Liste des Besoins des Étudiants</h2>

<a href="{{ route('needs.create') }}" class="btn btn-success mb-3">+ Ajouter un besoin</a>

{{-- Formulaire de filtrage --}}
<form method="GET" action="{{ route('needs.index') }}" class="row g-3 mb-4">
    <div class="col-md-3">
        <label class="form-label">Étudiant</label>
        <select name="student_id" class="form-select">
            <option value="">Tous les étudiants</option>
            @foreach($students as $student)
                <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                    {{ $student->first_name }} {{ $student->last_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">Type de besoin</label>
        <input type="text" name="type" class="form-control" value="{{ request('type') }}" placeholder="Rechercher par type">
    </div>
    <div class="col-md-3">
        <label class="form-label">Statut</label>
        <select name="status" class="form-select">
            <option value="">Tous les statuts</option>
            <option value="en attente" {{ request('status') == 'en attente' ? 'selected' : '' }}>En attente</option>
            <option value="en cours" {{ request('status') == 'en cours' ? 'selected' : '' }}>En cours</option>
            <option value="résolu" {{ request('status') == 'résolu' ? 'selected' : '' }}>Résolu</option>
        </select>
    </div>
    <div class="col-md-3 align-self-end">
        <div class="btn-group" role="group">
            <button type="submit" class="btn btn-primary">Filtrer</button>
            <a href="{{ route('needs.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
        </div>
    </div>
</form>

{{-- Liste paginée des besoins avec étudiant associé --}}
<table class="table table-bordered bg-white">
    <thead class="table-light">
        <tr>
            <th>Étudiant</th>
            <th>Type de besoin</th>
            <th>Description</th>
            <th>Statut</th>
            <th>Date d'enregistrement</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    {{-- Boucle des besoins; @forelse gère le cas sans données --}}
        @forelse($needs as $need)
        <tr>
            <td>{{ $need->student->first_name }} {{ $need->student->last_name }}</td>
            <td>{{ $need->type ?? 'Non spécifié' }}</td>
            <td>{{ Str::limit($need->description, 50) }}</td>
            <td>
                @if($need->status == 'en attente')
                    <span class="badge bg-warning">En attente</span>
                @elseif($need->status == 'en cours')
                    <span class="badge bg-primary">En cours</span>
                @elseif($need->status == 'résolu')
                    <span class="badge bg-success">Résolu</span>
                @else
                    <span class="badge bg-secondary">{{ $need->status }}</span>
                @endif
            </td>
            <td>{{ $need->created_at->format('d/m/Y H:i') }}</td>
            <td>
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('needs.edit', $need) }}" class="btn btn-primary">Modifier</a>
                    <form action="{{ route('needs.destroy', $need) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce besoin ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-muted">Aucun besoin enregistré.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- Liens de pagination avec conservation des filtres --}}
{{ $needs->appends(request()->query())->links() }}

<div class="mt-3">
    <p class="text-muted">
        <strong>Total:</strong> {{ $needs->total() }} besoins trouvés
    </p>
</div>
@endsection