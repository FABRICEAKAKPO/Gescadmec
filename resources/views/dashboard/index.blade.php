@extends('layouts.app')

@section('content')
<h2 class="marge-bas-4">Tableau de Bord </h2>

{{-- total payé, solde et dû --}}
<div class="ligne-centree marge-bas-4">
    <div class="colonne-md-4">
        <div class="carte bg-success texte-blanc ombre">
            <div class="corps-carte">
                <h4>{{ number_format($totalPaid, 0, ',', ' ') }} FCFA</h4>
                <p>Total des paiements reçus</p>
            </div>
        </div>
    </div>
    <div class="colonne-md-4">
        <div class="carte bg-warning texte-noir ombre">
            <div class="corps-carte">
                <h4>{{ number_format($totalBalance, 0, ',', ' ') }} FCFA</h4>
                <p>Soldes à payer</p>
            </div>
        </div>
    </div>
    <div class="colonne-md-4">
        <div class="carte bg-primary texte-blanc ombre">
            <div class="corps-carte">
                <h4>{{ number_format($totalDue, 0, ',', ' ') }} FCFA</h4>
                <p>Total global des formations</p>
            </div>
        </div>
    </div>
</div>

{{-- total payé, solde et dû --}}
<div class="ligne-centree marge-bas-4">
    <div class="colonne-md-6">
        <div class="carte bg-clair ombre">
            <div class="corps-carte">
                <h5 class="marge-bas-1">Total étudiants</h5>
                <div class="taille-police-4 gras">{{ $totalStudents }}</div>
            </div>
        </div>
    </div>
    <div class="colonne-md-6">
        <div class="carte bg-clair ombre">
            <div class="corps-carte">
                <h5 class="marge-bas-1">Total inscriptions</h5>
                <div class="taille-police-4 gras">{{ $totalEnrollments }}</div>
            </div>
        </div>
    </div>
</div>

<hr>

<h4 class="marge-haut-4">Cumul des paiements par niveau</h4>
{{-- Tableau cumul par niveau (dû, payé, reste) --}}
<table class="tableau-donnees bg-blanc marge-haut-3">
    <thead class="entete-tableau">
        <tr>
            <th>Niveau</th>
            <th>Total à payer</th>
            <th>Total payé</th>
            <th>Reste à payer</th>
        </tr>
    </thead>
    <tbody>
        @foreach($byLevel as $lvl)
        <tr class="ligne-tableau {{ $loop->index >= 5 ? 'cacher js-niveau-ligne' : '' }}">
            <td>{{ $lvl->level }}</td>
            <td>{{ number_format($lvl->total_amount, 0, ',', ' ') }} FCFA</td>
            <td>{{ number_format($lvl->total_paid, 0, ',', ' ') }} FCFA</td>
            <td class="{{ $lvl->balance > 0 ? 'texte-danger' : 'texte-success' }}">
                {{ number_format($lvl->balance, 0, ',', ' ') }} FCFA
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if(count($byLevel) > 5)
    <button class="bouton bouton-petit bouton-contour-primaire" id="basculer-niveau">Voir plus</button>
@endif

<hr>

<h4 class="marge-haut-4">Détails des étudiants et formations en cours</h4>
{{-- Détails des inscriptions actives: montre le solde et jours restants --}}
<table class="tableau-donnees bg-blanc marge-haut-3">
    <thead class="entete-tableau">
        <tr>
            <th>Étudiant</th>
            <th>Cours</th>
            <th>Niveau</th>
            <th>Montant total</th>
            <th>Payé</th>
            <th>Reste</th>
            <th>Jours restants</th>
        </tr>
    </thead>
    <tbody>
        @foreach($activeEnrollments as $e)
        <tr class="ligne-tableau {{ $loop->index >= 5 ? 'cacher js-inscription-ligne' : '' }}">
            <td>{{ $e->student->first_name }} {{ $e->student->last_name }}</td>
            <td>{{ $e->course->name ?? 'N/A' }}</td>
            <td>{{ $e->level }}</td>
            <td>{{ number_format($e->total_amount, 0, ',', ' ') }}</td>
            <td>{{ number_format($e->paid, 0, ',', ' ') }}</td>
            <td class="{{ $e->balance > 0 ? 'texte-danger' : 'texte-success' }}">
                {{ number_format($e->balance, 0, ',', ' ') }}
            </td>
            <td>
                @if($e->remaining_days > 0)
                    {{ (int) $e->remaining_days }} {{ $e->remaining_days > 1 ? 'jours' : 'jour' }}
                @else
                    <span class="texte-muet">Terminé</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@if(count($activeEnrollments) > 5)
    <button class="bouton bouton-petit bouton-contour-primaire" id="basculer-inscription">Voir plus</button>
@endif

{{-- Script pour basculer l'affichage de lignes supplémentaires --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
  var btnLevel = document.getElementById('basculer-niveau');
  if (btnLevel) {
    btnLevel.addEventListener('click', function() {
      var rows = document.querySelectorAll('.js-niveau-ligne');
      rows.forEach(function(r){ r.classList.toggle('cacher'); });
      btnLevel.textContent = btnLevel.textContent === 'Voir plus' ? 'Voir moins' : 'Voir plus';
    });
  }
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