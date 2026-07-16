@extends('layouts.app')

@section('content')

<h2>Modifier un décompte</h2>

<form action="{{ route('decomptes.update',$decompte->id) }}" method="POST">

@csrf
@method('PUT')

<label>Commande</label>

<select name="commande_id">

@foreach($commandes as $commande)

<option value="{{ $commande->id }}"
{{ $commande->id == $decompte->commande_id ? 'selected' : '' }}>

{{ $commande->code }}

</option>

@endforeach

</select>

<br><br>

<label>Date</label>

<input
type="date"
name="date"
value="{{ $decompte->date }}">

<br><br>

<label>Désignation</label>

<input
type="text"
name="designation"
value="{{ $decompte->designation }}">

<br><br>

<label>Quantité attachée</label>

<input
type="number"
step="0.01"
min="0"
name="quantite_attachee"
value="{{ $decompte->quantite_attachee }}">

<br><br>

<label>Numéro SAP</label>

<input
type="text"
name="num_ses"
value="{{ $decompte->num_ses }}">

<br><br>

<label>Numéro réception SAP</label>

<input
type="text"
name="num_rec_ses"
value="{{ $decompte->num_rec_ses }}">

<br><br>

<label>Statut validation</label>

<select name="statut_validation">

<option value="En attente"
{{ $decompte->statut_validation == 'En attente' ? 'selected' : '' }}>
En attente
</option>

<option value="Validé"
{{ $decompte->statut_validation == 'Validé' ? 'selected' : '' }}>
Validé
</option>

<option value="Refusé"
{{ $decompte->statut_validation == 'Refusé' ? 'selected' : '' }}>
Refusé
</option>

</select>

<br><br>

<button type="submit">

Modifier

</button>

</form>

@endsection