@extends('layouts.app')

@section('content')

<h2>Ajouter un décompte</h2>

<form action="{{ route('decomptes.store') }}" method="POST">

@csrf

<label>Commande</label>

<select name="commande_id">

<option value="">Choisir</option>

@foreach($commandes as $commande)

<option value="{{ $commande->id }}">

{{ $commande->code }}

</option>

@endforeach

</select>

<br><br>

<label>Date</label>

<input type="date" name="date">

<br><br>

<label>Désignation</label>

<input type="text" name="designation">

<br><br>

<label>Quantité attachée</label>

<input
type="number"
step="0.01"
min="0"
name="quantite_attachee">

<br><br>

<label>Numéro SAP</label>

<input type="text" name="num_ses">

<br><br>

<label>Numéro réception SAP</label>

<input type="text" name="num_rec_ses">

<br><br>

<label>Statut validation</label>

<select name="statut_validation">

<option value="En attente">

En attente

</option>

<option value="Validé">

Validé

</option>

<option value="Refusé">

Refusé

</option>

</select>

<br><br>

<button>

Ajouter

</button>

</form>

@endsection