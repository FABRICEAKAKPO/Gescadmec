{{-- Étend le layout principal --}}
@extends('layouts.app')

@section('content')
<h2>Liste des Inscriptions</h2>

<div class="alerte alerte-info marge-bas-3">Total inscriptions : <strong>{{ $totalEnrollments }}</strong></div>

<a href="{{ route('enrollments.create') }}" class="bouton bouton-succes marge-bas-3">+ Nouvelle inscription</a>

{{-- Formulaire de filtres: cours, niveau et statut de paiement --}}
<form method="GET" action="{{ route('enrollments.index') }}" class="ligne gouttiere-2 marge-bas-3">
    <div class="colonne-md-4">
        <label class="etiquette-formulaire">Cours</label>
{{-- Liste déroulante des cours, option 'Tous' pour ne pas filtrer --}}
        <select name="course_id" class="champ-formulaire">
            <option value="">Tous</option>
            @foreach($courses as $c)
                <option value="{{ $c->id }}" {{ request('course_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="colonne-md-4">
        <label class="etiquette-formulaire">Niveau</label>
        <input type="text" name="level" value="{{ request('level') }}" class="champ-formulaire" placeholder="Ex: A2, B1..." />
    </div>
    <div class="colonne-md-4">
        <label class="etiquette-formulaire">Statut</label>
        <select name="status" class="champ-formulaire">
            <option value="">Tous</option>
            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Payé</option>
            <option value="partial" {{ request('status') == 'partial' ? 'selected' : '' }}>Partiel</option>
            <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Impayé</option>
        </select>
    </div>
    <div class="colonne-12">
        <button class="bouton bouton-primaire">Filtrer</button>
        <a href="{{ route('enrollments.index') }}" class="bouton bouton-contour-secondaire">Réinitialiser</a>
    </div>
</form>
<table class="tableau-donnees bg-blanc">
    <thead class="entete-tableau">
        <tr>
            <th>Étudiant</th>
            <th>Cours</th>
            <th>Niveau</th>
            <th>Montant total</th>
            <th>Montant payé</th>
            <th>Reste à payer</th>
            <th>Date début</th>
            <th>Date fin</th>
            <th>Jours restants</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
{{-- Boucle sur les inscriptions; calcule payé, reste et jours restants --}}
        @forelse($enrollments as $enrollment)
        <tr class="ligne-tableau {{ $loop->index >= 5 ? 'cacher js-inscription-ligne' : '' }}">
            <td>{{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}</td>
            <td>{{ $enrollment->course->name ?? 'N/A' }}</td>
            <td>{{ $enrollment->level }}</td>
            <td>{{ number_format($enrollment->total_amount, 0, ',', ' ') }} FCFA</td>
            <td>{{ number_format($enrollment->payments->sum('amount'), 0, ',', ' ') }} FCFA</td>
            <td class="{{ $enrollment->remainingBalance() > 0 ? 'texte-danger' : 'texte-success' }}">
                {{ number_format($enrollment->remainingBalance(), 0, ',', ' ') }} FCFA
            </td>
            <td>{{ $enrollment->date_debut->format('d/m/Y') }}</td>
            <td>{{ $enrollment->date_fin->format('d/m/Y') }}</td>
            <td>
                @if($enrollment->remainingDays() > 0)
                    {{ (int) $enrollment->remainingDays() }} {{ $enrollment->remainingDays() > 1 ? 'jours' : 'jour' }}
                @else
                    <span class="texte-muet">Terminé</span>
                @endif
            </td>
            <td>
                @php($sumPaid = $enrollment->payments->sum('amount'))
                @php($total = $enrollment->total_amount)
                @if($total > 0 && $sumPaid >= $total)
                    <span class="badge bg-success">Payé</span>
                @elseif($sumPaid > 0 && $sumPaid < $total)
                    <span class="badge bg-warning text-dark">Partiel</span>
                @else
                    <span class="badge bg-danger">Impayé</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" class="texte-centre texte-muet">Aucune inscription enregistrée.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@if($enrollments->count() > 5)
    <button class="bouton bouton-petit bouton-contour-primaire" id="basculer-inscription">Voir plus</button>
@endif

{{-- Pagination avec conservation des paramètres via appends() --}}
{{ $enrollments->appends(request()->query())->links() }}

{{-- Script de toggle d'affichage des lignes supplémentaires --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
  var btnEnroll = document.getElementById('basculer-inscription');
  if (btnEnroll) {
    btnEnroll.addEventListener('click', function() {
      var rows = document.querySelectorAll('.js-inscription-ligne');
      rows.forEach(function(r){ r.classList.toggle('cacher'); });
      btnEnroll.textContent = btnEnroll.textContent === 'Voir plus' ? 'Voir moins' : 'Voir plus';
    });
  }
});
</script>
@endsection