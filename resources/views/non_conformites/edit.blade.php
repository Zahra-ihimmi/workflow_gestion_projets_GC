@extends('layouts.app')

@section('content')

<h2>Modifier une Non-conformité</h2>

<form action="{{ route('non-conformites.update',$nonConformite->id) }}" method="POST">

@csrf

@method('PUT')

<label>Commande</label>

<select name="commande_id">

@foreach($commandes as $commande)

<option
value="{{ $commande->id }}"
{{ $commande->id==$nonConformite->commande_id ? 'selected' : '' }}>

{{ $commande->code }}

</option>

@endforeach

</select>

<br><br>

<label>Date</label>

<input
type="date"
name="date"
value="{{ $nonConformite->date }}">

<br><br>

<label>Classe</label>

<select name="classe">

<option
value="Mineure"
{{ $nonConformite->classe=="Mineure" ? 'selected' : '' }}>

Mineure

</option>

<option
value="Majeure"
{{ $nonConformite->classe=="Majeure" ? 'selected' : '' }}>

Majeure

</option>

<option
value="Critique"
{{ $nonConformite->classe=="Critique" ? 'selected' : '' }}>

Critique

</option>

</select>

<br><br>

<label>Type</label>

<select name="type">

<option
value="Qualité"
{{ $nonConformite->type=="Qualité" ? 'selected' : '' }}>

Qualité

</option>

<option
value="HSE"
{{ $nonConformite->type=="HSE" ? 'selected' : '' }}>

HSE

</option>

</select>

<br><br>

<label>Echéance</label>

<input
type="date"
name="echeance"
value="{{ $nonConformite->echeance }}">

<br><br>

<label>Personnel</label>

<select name="personnel_cin">

@foreach($personnels as $personnel)

<option
value="{{ $personnel->cin }}"
{{ $personnel->cin==$nonConformite->personnel_cin ? 'selected' : '' }}>

{{ $personnel->nom }} {{ $personnel->prenom }}

</option>

@endforeach

</select>

<br><br>

<button>

Modifier

</button>

</form>

@endsection