{{-- Étend le layout principal --}}
@extends('layouts.app')

@section('content')
<h2 class="mb-4">Tableau de Bord </h2>

{{-- Cartes de synthèse: total payé, solde et dû --}}
<div class="row text-center mb-4">
    <div class="col-md-4">
        <div class="card bg-success text-white shadow-sm">
            <div class="card-body">
                <h4>{{ number_format($totalPaid, 0, ',', ' ') }} FCFA</h4>
                <p>Total des paiements reçus</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-warning text-dark shadow-sm">
            <div class="card-body">
                <h4>{{ number_format($totalBalance, 0, ',', ' ') }} FCFA</h4>
                <p>Soldes à payer</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-primary text-white shadow-sm">
            <div class="card-body">
                <h4>{{ number_format($totalDue, 0, ',', ' ') }} FCFA</h4>
                <p>Total global des formations</p>
            </div>
        </div>
    </div>
</div>

{{-- Cartes de synthèse: total payé, solde et dû --}}
<div class="row text-center mb-4">
    <div class="col-md-6">
        <div class="card bg-light shadow-sm">
            <div class="card-body">
                <h5 class="mb-1">Total étudiants</h5>
                <div class="fs-4 fw-bold">{{ $totalStudents }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-light shadow-sm">
            <div class="card-body">
                <h5 class="mb-1">Total inscriptions</h5>
                <div class="fs-4 fw-bold">{{ $totalEnrollments }}</div>
            </div>
        </div>
    </div>
</div>

<hr>

<h4 class="mt-4">Cumul des paiements par niveau</h4>
{{-- Tableau cumul par niveau (dû, payé, reste) --}}
<table class="table table-bordered bg-white mt-3">
    <thead class="table-light">
        <tr>
            <th>Niveau</th>
            <th>Total à payer</th>
            <th>Total payé</th>
            <th>Reste à payer</th>
        </tr>
    </thead>
    <tbody>
        @foreach($byLevel as $lvl)
        <tr class="{{ $loop->index >= 5 ? 'd-none js-level-row' : '' }}">
            <td>{{ $lvl->level }}</td>
            <td>{{ number_format($lvl->total_amount, 0, ',', ' ') }} FCFA</td>
            <td>{{ number_format($lvl->total_paid, 0, ',', ' ') }} FCFA</td>
            <td class="{{ $lvl->balance > 0 ? 'text-danger' : 'text-success' }}">
                {{ number_format($lvl->balance, 0, ',', ' ') }} FCFA
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if(count($byLevel) > 5)
    <button class="btn btn-sm btn-outline-primary" id="toggle-level">Voir plus</button>
@endif

<hr>

<h4 class="mt-4">Détails des étudiants et formations en cours</h4>
{{-- Détails des inscriptions actives: montre le solde et jours restants --}}
<table class="table table-striped bg-white mt-3">
    <thead class="table-light">
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
        <tr class="{{ $loop->index >= 5 ? 'd-none js-enroll-row' : '' }}">
            <td>{{ $e->student->first_name }} {{ $e->student->last_name }}</td>
            <td>{{ $e->course->name ?? 'N/A' }}</td>
            <td>{{ $e->level }}</td>
            <td>{{ number_format($e->total_amount, 0, ',', ' ') }}</td>
            <td>{{ number_format($e->paid, 0, ',', ' ') }}</td>
            <td class="{{ $e->balance > 0 ? 'text-danger' : 'text-success' }}">
                {{ number_format($e->balance, 0, ',', ' ') }}
            </td>
            <td>
                @if($e->remaining_days > 0)
                    {{ (int) $e->remaining_days }} {{ $e->remaining_days > 1 ? 'jours' : 'jour' }}
                @else
                    <span class="text-muted">Terminé</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@if(count($activeEnrollments) > 5)
    <button class="btn btn-sm btn-outline-primary" id="toggle-enroll">Voir plus</button>
@endif

{{-- Script pour basculer l'affichage de lignes supplémentaires --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
  var btnLevel = document.getElementById('toggle-level');
  if (btnLevel) {
    btnLevel.addEventListener('click', function() {
      var rows = document.querySelectorAll('.js-level-row');
      rows.forEach(function(r){ r.classList.toggle('d-none'); });
      btnLevel.textContent = btnLevel.textContent === 'Voir plus' ? 'Voir moins' : 'Voir plus';
    });
  }
  var btnEnroll = document.getElementById('toggle-enroll');
  if (btnEnroll) {
    btnEnroll.addEventListener('click', function() {
      var rows = document.querySelectorAll('.js-enroll-row');
      rows.forEach(function(r){ r.classList.toggle('d-none'); });
      btnEnroll.textContent = btnEnroll.textContent === 'Voir plus' ? 'Voir moins' : 'Voir plus';
    });
  }
});
</script>
@endsection
