@extends('layouts.app')

@section('content')

<h2>Modifier un Personnel</h2>

<form action="{{ route('personnels.update',$personnel->id) }}" method="POST">

@csrf

@method('PUT')

<label>CIN</label>

<input
type="text"
name="cin"
value="{{ $personnel->cin }}">

<br><br>

<label>Fournisseur</label>

<select name="fournisseur_id">

@foreach($fournisseurs as $fournisseur)

<option
value="{{ $fournisseur->id }}"
{{ $personnel->fournisseur_id==$fournisseur->id ? 'selected' : '' }}>

{{ $fournisseur->nom }}

</option>

@endforeach

</select>

<br><br>

<label>Nom</label>

<input
type="text"
name="nom"
value="{{ $personnel->nom }}">

<br><br>

<label>Prénom</label>

<input
type="text"
name="prenom"
value="{{ $personnel->prenom }}">

<br><br>

<label>Fonction</label>

<input
type="text"
name="fonction"
value="{{ $personnel->fonction }}">

<br><br>

<label>Photo</label>

<input
type="text"
name="photo"
value="{{ $personnel->photo }}">

<br><br>

<label>Type de contrat</label>

<select name="type_contrat">

<option value="CDI"
{{ $personnel->type_contrat=="CDI" ? 'selected' : '' }}>

CDI

</option>

<option value="CDD"
{{ $personnel->type_contrat=="CDD" ? 'selected' : '' }}>

CDD

</option>

<option value="Intérim"
{{ $personnel->type_contrat=="Intérim" ? 'selected' : '' }}>

Intérim

</option>

<option value="Sous-traitant"
{{ $personnel->type_contrat=="Sous-traitant" ? 'selected' : '' }}>

Sous-traitant

</option>

</select>

<br><br>

<label>PNE</label>

<input
type="text"
name="pne"
value="{{ $personnel->pne }}">

<br><br>

<label>Niveau</label>

<input
type="text"
name="niveau"
value="{{ $personnel->niveau }}">

<br><br>

<label>Date début</label>

<input
type="date"
name="date_debut"
value="{{ $personnel->date_debut }}">

<br><br>

<label>Date fin</label>

<input
type="date"
name="date_fin"
value="{{ $personnel->date_fin }}">

<br><br>

<button>

Modifier

</button>

</form>

@endsection