@extends('layouts.app')

@section('content')

<h2>Ajouter un Prix</h2>

<form action="{{ route('prix.store') }}" method="POST">

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

<label>Désignation</label>

<input
type="text"
name="designation">

<br><br>

<label>Quantité</label>

<input
type="number"
step="0.01"
min="0"
name="quantite">

<br><br>

<label>Prix unitaire</label>

<input
type="number"
step="0.01"
min="0"
name="prix_unitaire">

<br><br>

<button>

Ajouter

</button>

</form>

@endsection