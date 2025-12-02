{{-- Étend le layout principal pour réutiliser l'entête/side-menu --}}
@extends('layouts.app')

{{-- Début de la section de contenu injectée dans layouts.app --}}
@section('content')
<h2>Liste des Étudiants</h2>

<div class="alerte alerte-info marge-bas-3">Total étudiants enregistrés : <strong>{{ $totalStudents }}</strong></div>

{{-- Lien vers le formulaire d'ajout d'un étudiant --}}
<a href="{{ route('students.create') }}" class="bouton bouton-succes marge-bas-3">+ Ajouter un étudiant</a>

{{-- Formulaire GET: garde les filtres dans l'URL et permet pagination avec appends() --}}
<form method="GET" action="{{ route('students.index') }}" class="ligne gouttiere-2 marge-bas-3">
    <div class="colonne-md-6">
        <label class="etiquette-formulaire">Recherche</label>
        <input type="text" name="q" value="{{ request('q') }}" class="champ-formulaire" placeholder="Nom, email, téléphone" />
    </div>
    <div class="colonne-12">
        <button class="bouton bouton-primaire">Filtrer</button>
        <a href="{{ route('students.index') }}" class="bouton bouton-contour-secondaire">Réinitialiser</a>
    </div>
</form>
<table class="tableau-donnees bg-blanc">
    <thead class="entete-tableau">
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
        <tr class="ligne-tableau {{ $loop->index >= 5 ? 'cacher js-etudiant-ligne' : '' }}">
            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->phone }}</td>
            <td>{{ $student->address }}</td>
            <td>
                <a href="{{ route('students.edit', $student) }}" class="bouton bouton-primaire bouton-petit" style="affichage: inline-block; marge-droite: 5px;">Modifier</a>
                <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ? Cette action est irréversible.')" style="affichage: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bouton bouton-danger bouton-petit">Supprimer</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="texte-centre texte-muet">Aucun étudiant enregistré.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@if($students->count() > 5)
    <button class="bouton bouton-petit bouton-contour-primaire" id="basculer-etudiant">Voir plus</button>
@endif

{{-- Pagination avec conservation des filtres via appends() --}}
{{ $students->appends(request()->query())->links() }}

{{-- Script de toggle d'affichage des lignes supplémentaires --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
  var btnStu = document.getElementById('basculer-etudiant');
  if (btnStu) {
    btnStu.addEventListener('click', function() {
      var rows = document.querySelectorAll('.js-etudiant-ligne');
      rows.forEach(function(r){ r.classList.toggle('cacher'); });
      btnStu.textContent = btnStu.textContent === 'Voir plus' ? 'Voir moins' : 'Voir plus';
    });
  }
});
</script>
@endsection