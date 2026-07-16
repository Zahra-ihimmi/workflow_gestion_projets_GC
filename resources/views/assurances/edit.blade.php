@extends('layouts.app')

@section('content')

<h2>Modifier une Assurance</h2>

<form action="{{ route('assurances.update',$assurance->id) }}" method="POST">

@csrf

@method('PUT')

<label>Fournisseur</label>

<select name="fournisseur_id">

@foreach($fournisseurs as $fournisseur)

<option
value="{{ $fournisseur->id }}"
{{ $assurance->fournisseur_id==$fournisseur->id ? 'selected' : '' }}>

{{ $fournisseur->nom }}

</option>

@endforeach

</select>

<br><br>

<label>Type</label>

<select name="type">

<option value="Responsabilité Civile" {{ $assurance->type=="Responsabilité Civile" ? 'selected':'' }}>Responsabilité Civile</option>

<option value="Décennale" {{ $assurance->type=="Décennale" ? 'selected':'' }}>Décennale</option>

<option value="Tous Risques Chantier" {{ $assurance->type=="Tous Risques Chantier" ? 'selected':'' }}>Tous Risques Chantier</option>

<option value="Accident de Travail" {{ $assurance->type=="Accident de Travail" ? 'selected':'' }}>Accident de Travail</option>

<option value="Transport" {{ $assurance->type=="Transport" ? 'selected':'' }}>Transport</option>

<option value="Autre" {{ $assurance->type=="Autre" ? 'selected':'' }}>Autre</option>

</select>

<br><br>

<label>Numéro de police</label>

<input
type="text"
name="police"
value="{{ $assurance->police }}">

<br><br>

<label>Date début</label>

<input
type="date"
name="date_debut"
value="{{ $assurance->date_debut }}">

<br><br>

<label>Date fin</label>

<input
type="date"
name="date_fin"
value="{{ $assurance->date_fin }}">

<br><br>

<label>Quittance</label>

<input
type="text"
name="quittance"
value="{{ $assurance->quittance }}">

<br><br>

<button>

Modifier

</button>

</form>

@endsection