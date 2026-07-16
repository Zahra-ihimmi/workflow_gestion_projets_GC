@extends('layouts.app')

@section('content')

<h2>Ajouter un Personnel</h2>

<form action="{{ route('personnels.store') }}" method="POST">

@csrf

<label>CIN</label>

<input type="text" name="cin">

<br><br>

<label>Fournisseur</label>

<select name="fournisseur_id">

<option value="">Choisir</option>

@foreach($fournisseurs as $fournisseur)

<option value="{{ $fournisseur->id }}">

{{ $fournisseur->nom }}

</option>

@endforeach

</select>

<br><br>

<label>Nom</label>

<input type="text" name="nom">

<br><br>

<label>Prénom</label>

<input type="text" name="prenom">

<br><br>

<label>Fonction</label>

<input type="text" name="fonction">

<br><br>

<label>Photo</label>

<input type="text" name="photo">

<br><br>

<label>Type de contrat</label>

<select name="type_contrat">

<option value="">Choisir</option>

<option value="CDI">CDI</option>

<option value="CDD">CDD</option>

<option value="Intérim">Intérim</option>

<option value="Sous-traitant">Sous-traitant</option>

</select>

<br><br>

<label>PNE</label>

<input type="text" name="pne">

<br><br>

<label>Niveau</label>

<input type="text" name="niveau">

<br><br>

<label>Date début</label>

<input type="date" name="date_debut">

<br><br>

<label>Date fin</label>

<input type="date" name="date_fin">

<br><br>

<button>

Ajouter

</button>

</form>

@endsection