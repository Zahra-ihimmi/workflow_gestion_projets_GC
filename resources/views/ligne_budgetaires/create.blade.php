@extends('layouts.app')


@section('content')


<h2>Ajouter une Ligne Budgétaire</h2>


<form action="{{ route('ligne-budgetaires.store') }}" method="POST">

@csrf


<label>Utilisateur</label>

<select name="utilisateur_id" required>
    <option value="">-- Sélectionner un utilisateur --</option>

    @foreach($utilisateurs as $utilisateur)
        <option value="{{ $utilisateur->id }}">
            {{ $utilisateur->nom }} {{ $utilisateur->prenom }}
        </option>
    @endforeach
</select>


<br>




<label>Intitulé</label>

<input type="text" name="intitule">


<br>


<label>Année</label>

<input type="number" name="annee">


<br>


<label>Type</label>

<input type="text" name="type">


<br>


<label>Client</label>

<input type="text" name="client">


<br>


<label>Date objective</label>

<input type="date" name="date_objective">


<br>


<label>Montant estimatif</label>

<input type="number" step="0.01" name="montant_estimatif" min="0">


<br>


<label>Statut</label>

<input type="text" name="statut">


<br><br>


<button type="submit">

Ajouter

</button>


</form>


@endsection