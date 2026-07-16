@extends('layouts.app')

@section('content')

<h2>Ajouter un Rapport de Travaux</h2>

<form action="{{ route('rapport-travaux.store') }}" method="POST">

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

<label>Ecart HSE</label>

<select name="ecart_hse">

<option value="Non">Non</option>

<option value="Oui">Oui</option>

</select>

<br><br>

<label>Ecart Qualité</label>

<select name="ecart_qualite">

<option value="Non">Non</option>

<option value="Oui">Oui</option>

</select>

<br><br>

<button>

Ajouter

</button>

</form>

@endsection