@extends('layouts.app')


@section('content')


<h2>Ajouter une demande d'achat</h2>


<form action="{{ route('demande-achats.store') }}" method="POST">

@csrf


<label>Code</label>
<input type="text" name="code">

<br><br>


<label>ID Ligne Budgétaire</label>
<input type="number" name="ligne_budgetaire_id">

<br><br>


<label>ID Utilisateur</label>
<input type="number" name="utilisateur_id">

<br><br>


<label>Estimation</label>
<input type="number" step="0.01" name="estimation"  min="0">

<br><br>


<label>Date saisi</label>
<input type="date" name="date_saisi">

<br><br>


<label>Acheteur</label>
<input type="text" name="acheteur">

<br><br>


<label>Type projet</label>
<input type="text" name="type_projet">

<br><br>


<label>Catégorie</label>
<input type="text" name="categorie">

<br><br>


<label>Statut</label>
<input type="text" name="statut">


<br><br>


<button type="submit">

Ajouter

</button>


</form>


@endsection