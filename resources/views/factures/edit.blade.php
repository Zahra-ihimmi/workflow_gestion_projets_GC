@extends('layouts.app')

@section('content')

<h2>Modifier une Facture</h2>

<form action="{{ route('factures.update',$facture->id) }}" method="POST">

@csrf

@method('PUT')

<label>Décompte</label>

<select name="decompte_id">

@foreach($decomptes as $decompte)

<option
value="{{ $decompte->id }}"
{{ $facture->decompte_id==$decompte->id ? 'selected' : '' }}>

{{ $decompte->code }}

</option>

@endforeach

</select>

<br><br>

<label>Date dépôt</label>

<input
type="date"
name="date_depot"
value="{{ $facture->date_depot }}">

<br><br>

<label>Montant</label>

<input
type="number"
step="0.01"
min="0"
name="montant"
value="{{ $facture->montant }}">

<br><br>

<button>

Modifier

</button>

</form>

@endsection
