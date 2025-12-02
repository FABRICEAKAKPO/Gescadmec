{{-- Étend le layout principal --}}
@extends('layouts.app')

@section('content')
<h2>Liste des Besoins des Étudiants</h2>

<a href="{{ route('needs.create') }}" class="bouton bouton-succes marge-bas-3">+ Ajouter un besoin</a>

{{-- Formulaire de filtrage --}}
<form method="GET" action="{{ route('needs.index') }}" class="ligne gouttiere-3 marge-bas-4">
    <div class="colonne-md-3">
        <label class="etiquette-formulaire">Étudiant</label>
        <select name="student_id" class="champ-formulaire">
            <option value="">Tous les étudiants</option>
            @foreach($students as $student)
                <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                    {{ $student->first_name }} {{ $student->last_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="colonne-md-3">
        <label class="etiquette-formulaire">Type de besoin</label>
        <input type="text" name="type" class="champ-formulaire" value="{{ request('type') }}" placeholder="Rechercher par type">
    </div>
    <div class="colonne-md-3">
        <label class="etiquette-formulaire">Statut</label>
        <select name="status" class="champ-formulaire">
            <option value="">Tous les statuts</option>
            <option value="en attente" {{ request('status') == 'en attente' ? 'selected' : '' }}>En attente</option>
            <option value="en cours" {{ request('status') == 'en cours' ? 'selected' : '' }}>En cours</option>
            <option value="résolu" {{ request('status') == 'résolu' ? 'selected' : '' }}>Résolu</option>
        </select>
    </div>
    <div class="colonne-md-3 aligner-soi-fin">
        <div class="groupe-boutons" role="groupe">
            <button type="submit" class="bouton bouton-primaire">Filtrer</button>
            <a href="{{ route('needs.index') }}" class="bouton bouton-contour-secondaire">Réinitialiser</a>
        </div>
    </div>
</form>

{{-- Liste paginée des besoins avec étudiant associé --}}
<table class="tableau-donnees bg-blanc">
    <thead class="entete-tableau">
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
        <tr class="ligne-tableau">
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
                <div class="groupe-boutons groupe-boutons-petit" role="groupe">
                    <a href="{{ route('needs.edit', $need) }}" class="bouton bouton-primaire">Modifier</a>
                    <form action="{{ route('needs.destroy', $need) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce besoin ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bouton bouton-danger">Supprimer</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="texte-centre texte-muet">Aucun besoin enregistré.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- Liens de pagination avec conservation des filtres --}}
{{ $needs->appends(request()->query())->links() }}

<div class="marge-haut-3">
    <p class="texte-muet">
        <strong>Total:</strong> {{ $needs->total() }} besoins trouvés
    </p>
</div>
@endsection