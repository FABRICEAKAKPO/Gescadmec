{{-- Étend le layout principal --}}
@extends('layouts.app')

@section('content')
<h2>Liste des Paiements</h2>

<a href="{{ route('payments.create') }}" class="bouton bouton-succes marge-bas-3">+ Nouveau paiement</a>

{{-- Formulaire de filtres des paiements --}}
<form method="GET" action="{{ route('payments.index') }}" class="ligne gouttiere-2 marge-bas-3">
    <div class="colonne-md-3">
        <label class="etiquette-formulaire">Étudiant</label>
        <select name="student_id" class="champ-formulaire">
            <option value="">Tous</option>
            @foreach($students as $stu)
                <option value="{{ $stu->id }}" {{ request('student_id') == $stu->id ? 'selected' : '' }}>
                    {{ $stu->first_name }} {{ $stu->last_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="colonne-md-3">
        <label class="etiquette-formulaire">Cours</label>
        <select name="course_id" class="champ-formulaire">
            <option value="">Tous</option>
            @foreach($courses as $c)
                <option value="{{ $c->id }}" {{ request('course_id') == $c->id ? 'selected' : '' }}>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="colonne-md-2">
        <label class="etiquette-formulaire">Méthode</label>
        <select name="method" class="champ-formulaire">
            <option value="">Toutes</option>
            @foreach($methods as $m)
                <option value="{{ $m }}" {{ request('method') == $m ? 'selected' : '' }}>{{ $m }}</option>
            @endforeach
        </select>
    </div>
    <div class="colonne-md-2">
        <label class="etiquette-formulaire">Du</label>
        <input type="date" name="date_from" value="{{ request('date_from') }}" class="champ-formulaire" />
    </div>
    <div class="colonne-md-2">
        <label class="etiquette-formulaire">Au</label>
        <input type="date" name="date_to" value="{{ request('date_to') }}" class="champ-formulaire" />
    </div>
    <div class="colonne-12">
        <button class="bouton bouton-primaire">Filtrer</button>
        <a href="{{ route('payments.index') }}" class="bouton bouton-contour-secondaire">Réinitialiser</a>
    </div>
</form>
{{-- Alerte de succès avec lien direct vers le reçu, si disponible --}}
@if(session('receipt_url'))
    <div class="alerte alerte-succes">
        Paiement enregistré. <a href="{{ session('receipt_url') }}" target="_blank" class="alerte-lien">Ouvrir le reçu</a>
    </div>
@elseif(session('success'))
    <div class="alerte alerte-succes">{{ session('success') }}</div>
@endif

<table class="tableau-donnees bg-blanc">
    <thead class="entete-tableau">
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
        <tr class="ligne-tableau {{ $loop->index >= 5 ? 'cacher js-paiement-ligne' : '' }}">
            <td>{{ $payment->receipt_number }}</td>
            <td>{{ $payment->enrollment->student->first_name }} {{ $payment->enrollment->student->last_name }}</td>
            <td>{{ $payment->enrollment->course->name ?? 'N/A' }}</td>
            <td>{{ number_format($payment->amount, 0, ',', ' ') }} FCFA</td>
            <td>{{ $payment->method ?? 'Non spécifiée' }}</td>
            <td>{{ $payment->paid_at->format('d/m/Y H:i') }}</td>
            <td><span class="badge bg-success">Payé</span></td>
            {{-- Bouton pour ouvrir le reçu du paiement --}}
            <td>
                <a href="{{ route('payments.receipt', $payment->id) }}" target="_blank" class="bouton bouton-petit bouton-primaire">Voir reçu</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="texte-centre texte-muet">Aucun paiement enregistré.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@if($payments->count() > 5)
    <button class="bouton bouton-petit bouton-contour-primaire" id="basculer-paiement">Voir plus</button>
@endif

{{-- Pagination avec conservation des filtres via appends() --}}
{{ $payments->appends(request()->query())->links() }}

{{-- Script pour afficher/masquer des lignes de plus de 5 --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
  var btnPay = document.getElementById('basculer-paiement');
  if (btnPay) {
    btnPay.addEventListener('click', function() {
      var rows = document.querySelectorAll('.js-paiement-ligne');
      rows.forEach(function(r){ r.classList.toggle('cacher'); });
      btnPay.textContent = btnPay.textContent === 'Voir plus' ? 'Voir moins' : 'Voir plus';
    });
  }
});
</script>
@endsection