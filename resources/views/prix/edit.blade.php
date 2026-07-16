@extends('layouts.app')

@section('content')

<h2>Modifier un Prix</h2>

<form action="{{ route('prix.update',$prix->id) }}" method="POST">

@csrf

@method('PUT')

<label>Commande</label>

<select name="commande_id">

@foreach($commandes as $commande)

<option
value="{{ $commande->id }}"
{{ $commande->id == $prix->commande_id ? 'selected' : '' }}>

{{ $commande->code }}

</option>

@endforeach

</select>

<br><br>

<label>Désignation</label>

<input
type="text"
name="designation"
value="{{ $prix->designation }}">

<br><br>

<label>Quantité</label>

<input
type="number"
step="0.01"
min="0"
name="quantite"
value="{{ $prix->quantite }}">

<br><br>

<label>Prix unitaire</label>

<input
type="number"
step="0.01"
min="0"
name="prix_unitaire"
value="{{ $prix->prix_unitaire }}">

<br><br>

<button>

Modifier

</button>

</form>

@endsection