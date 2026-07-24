@extends('layouts.app')
@section('breadcrumb', "Liste des Plans d'Action")
@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Liste des Plans d'Action</h2>

        <a href="{{ route('plan-actions.create') }}" class="btn btn-primary">
            Ajouter un Plan d'Action
        </a>

    </div>

<br><br>

<table border="1">

<tr>

<th>Code</th>

<th>Commande</th>

<th>Personnel</th>

<th>Date SPA</th>

<th>Activité</th>

<th>Dangers</th>

<th>Mesures préventives</th>

<th>Actions</th>

</tr>

@foreach($planActions as $plan)

<tr id="plan-action-{{ $plan->id }}"
    class="{{ request('highlight') == $plan->id ? 'highlight-row' : '' }}">

<td>{{ $plan->code }}</td>

<td>{{ $plan->commande->code }}</td>

<td>{{ $plan->personnel->nom }} {{ $plan->personnel->prenom }}</td>

<td>{{ $plan->date_spa }}</td>

<td>{{ $plan->activite }}</td>

<td>{{ $plan->dangers }}</td>

<td>{{ $plan->mesures_preventives }}</td>

<td>

<a href="{{ route('plan-actions.edit',$plan->id) }}"
class="btn btn-success btn-sm"
   title="Modifier">
    <i class="fa-solid fa-pen-to-square"></i>

</a>

<form id="delete-form-{{ $plan->id }}"
      action="{{ route('plan-actions.destroy', $plan->id) }}"
      method="POST"
      class="d-inline">

    @csrf
    @method('DELETE')

    <button type="button"
            class="btn btn-danger btn-sm"
            onclick="confirmDelete({{ $plan->id }})"
            title="Supprimer">
        <i class="fa-solid fa-trash"></i>
    </button>

</form>

</td>

</tr>

@endforeach

</table>

</div>

@endsection