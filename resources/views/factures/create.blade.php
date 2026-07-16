@extends('layouts.app')

@section('content')

<h2>Ajouter une Facture</h2>

<form action="{{ route('factures.store') }}" method="POST">

@csrf

<label>Décompte</label>

<select name="decompte_id">

<option value="">Choisir</option>

@foreach($decomptes as $decompte)

<option value="{{ $decompte->id }}">

{{ $decompte->code }}

</option>

@endforeach

</select>

<br><br>

<label>Date dépôt</label>

<input
type="date"
name="date_depot">

<br><br>

<label>Montant</label>

<input
type="number"
step="0.01"
min="0"
name="montant">

<br><br>

<button>

Ajouter

</button>

</form>

@endsection