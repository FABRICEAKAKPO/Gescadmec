{{-- Étend le layout principal --}}
@extends('layouts.app')

@section('content')
<h2>Liste des Paiements</h2>

<a href="{{ route('payments.create') }}" class="btn btn-success mb-3">+ Nouveau paiement</a>

{{-- Formulaire de filtres des paiements --}}
<form method="GET" action="{{ route('payments.index') }}" class="row g-2 mb-3">
    <div class="col-md-3">
        <label class="form-label">Étudiant</label>
        <select name="student_id" class="form-select">
            <option value="">Tous</option>
            @foreach($students as $stu)
                <option value="{{ $stu->id }}" {{ request('student_id') == $stu->id ? 'selected' : '' }}>
                    {{ $stu->first_name }} {{ $stu->last_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">Cours</label>
        <select name="course_id" class="form-select">
            <option value="">Tous</option>
            @foreach($courses as $c)
                <option value="{{ $c->id }}" {{ request('course_id') == $c->id ? 'selected' : '' }}>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <label class="form-label">Méthode</label>
        <select name="method" class="form-select">
            <option value="">Toutes</option>
            @foreach($methods as $m)
                <option value="{{ $m }}" {{ request('method') == $m ? 'selected' : '' }}>{{ $m }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <label class="form-label">Du</label>
        <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control" />
    </div>
    <div class="col-md-2">
        <label class="form-label">Au</label>
        <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control" />
    </div>
    <div class="col-12">
        <button class="btn btn-primary">Filtrer</button>
        <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
    </div>
</form>
{{-- Alerte de succès avec lien direct vers le reçu, si disponible --}}
@if(session('receipt_url'))
    <div class="alert alert-success">
        Paiement enregistré. <a href="{{ session('receipt_url') }}" target="_blank" class="alert-link">Ouvrir le reçu</a>
    </div>
@elseif(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered bg-white">
    <thead class="table-light">
        <tr>
            <th>Numéro reçu</th>
            <th>Étudiant</th>
            <th>Cours</th>
            <th>Montant payé</th>
            <th>Méthode</th>
            <th>Date paiement</th>
            <th>Statut</th>
            <th>Reçu</th>
        </tr>
    </thead>
{{-- Tableau des paiements; chaque ligne affiche les relations (étudiant, cours) --}}
    <tbody>
        @forelse($payments as $payment)
        <tr class="{{ $loop->index >= 5 ? 'd-none js-pay-row' : '' }}">
            <td>{{ $payment->receipt_number }}</td>
            <td>{{ $payment->enrollment->student->first_name }} {{ $payment->enrollment->student->last_name }}</td>
            <td>{{ $payment->enrollment->course->name ?? 'N/A' }}</td>
            <td>{{ number_format($payment->amount, 0, ',', ' ') }} FCFA</td>
            <td>{{ $payment->method ?? 'Non spécifiée' }}</td>
            <td>{{ $payment->paid_at->format('d/m/Y H:i') }}</td>
            <td><span class="badge bg-success">Payé</span></td>
            {{-- Bouton pour ouvrir le reçu du paiement --}}
            <td>
                <a href="{{ route('payments.receipt', $payment->id) }}" target="_blank" class="btn btn-sm btn-primary">Voir reçu</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center text-muted">Aucun paiement enregistré.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@if($payments->count() > 5)
    <button class="btn btn-sm btn-outline-primary" id="toggle-pay">Voir plus</button>
@endif

{{-- Pagination avec conservation des filtres via appends() --}}
{{ $payments->appends(request()->query())->links() }}

{{-- Script pour afficher/masquer des lignes de plus de 5 --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
  var btnPay = document.getElementById('toggle-pay');
  if (btnPay) {
    btnPay.addEventListener('click', function() {
      var rows = document.querySelectorAll('.js-pay-row');
      rows.forEach(function(r){ r.classList.toggle('d-none'); });
      btnPay.textContent = btnPay.textContent === 'Voir plus' ? 'Voir moins' : 'Voir plus';
    });
  }
});
</script>
@endsection
