@extends('layouts.app')

@section('content')

<h2>Modifier un Rapport de Travaux</h2>

<form action="{{ route('rapport-travaux.update',$rapport->id) }}" method="POST">

@csrf
@method('PUT')

<label>Commande</label>

<select name="commande_id">

@foreach($commandes as $commande)

<option
value="{{ $commande->id }}"
{{ $commande->id == $rapport->commande_id ? 'selected' : '' }}>

{{ $commande->code }}

</option>

@endforeach

</select>

<br><br>

<label>Date</label>

<input
type="date"
name="date"
value="{{ $rapport->date }}">

<br><br>

<label>Ecart HSE</label>

<select name="ecart_hse">

<option value="Non"
{{ $rapport->ecart_hse == 'Non' ? 'selected' : '' }}>
Non
</option>

<option value="Oui"
{{ $rapport->ecart_hse == 'Oui' ? 'selected' : '' }}>
Oui
</option>

</select>

<br><br>

<label>Ecart Qualité</label>

<select name="ecart_qualite">

<option value="Non"
{{ $rapport->ecart_qualite == 'Non' ? 'selected' : '' }}>
Non
</option>

<option value="Oui"
{{ $rapport->ecart_qualite == 'Oui' ? 'selected' : '' }}>
Oui
</option>

</select>

<br><br>

<button>

Modifier

</button>

</form>

@endsection