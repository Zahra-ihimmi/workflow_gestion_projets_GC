@extends('layouts.app')

@section('title','Modifier Ligne Budgétaire')


@section('content')


<div class="container">


<h2>Modifier la ligne budgétaire</h2>


<form action="{{ route('ligne-budgetaires.update',$ligneBudgetaire->id) }}"
      method="POST">


@csrf

@method('PUT')



<div class="mb-3">

<label>Intitulé</label>

<input type="text"
       name="intitule"
       class="form-control"
       value="{{ $ligneBudgetaire->intitule }}">

</div>



<div class="mb-3">

<label>Année</label>

<input type="number"
       name="annee"
       class="form-control"
       value="{{ $ligneBudgetaire->annee }}">

</div>



<div class="mb-3">

<label>Type</label>

<input type="text"
       name="type"
       class="form-control"
       value="{{ $ligneBudgetaire->type }}">

</div>



<div class="mb-3">

<label>Client</label>

<input type="text"
       name="client"
       class="form-control"
       value="{{ $ligneBudgetaire->client }}">

</div>



<div class="mb-3">

<label>Date objective</label>

<input type="date"
       name="date_objective"
       class="form-control"
       value="{{ $ligneBudgetaire->date_objective }}">

</div>



<div class="mb-3">

<label>Montant estimatif</label>

<input type="number"
       step="0.01"
       name="montant_estimatif"
       class="form-control"
       value="{{ $ligneBudgetaire->montant_estimatif }}">

</div>



<div class="mb-3">

<label>Statut</label>

<input type="text"
       name="statut"
       class="form-control"
       value="{{ $ligneBudgetaire->statut }}">

</div>




<button class="btn btn-primary">

Enregistrer les modifications

</button>


<a href="{{ route('ligne-budgetaires.index') }}"
   class="btn btn-secondary">

Retour

</a>



</form>


</div>


@endsection