@extends('layouts.app')
@section('breadcrumb', 'Liste des Plannings')
@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Liste des Plannings</h2>

        <a href="{{ route('plannings.create') }}" class="btn btn-primary">
            Ajouter un Planning
        </a>

    </div>

<br><br>

<table border="1">

<tr>

<th>Code</th>

<th>Prix</th>

<th>Désignation</th>

<th>Date début</th>

<th>Date fin prévue</th>

<th>Date début réelle</th>

<th>Actions</th>

</tr>

@foreach($plannings as $planning)

<tr>

<td>{{ $planning->code }}</td>

<td>{{ $planning->prix->code }}</td>

<td>{{ $planning->designation }}</td>

<td>{{ $planning->date_debut }}</td>

<td>{{ $planning->date_fin_prevue }}</td>

<td>{{ $planning->date_debut_reelle }}</td>

<td>

<a href="{{ route('plannings.edit',$planning->id) }}"
    class="btn btn-success btn-sm"
    title="Modifier">
    <i class="fa-solid fa-pen-to-square"></i>
</a>

<form id="delete-form-{{ $planning->id }}"
      action="{{ route('plannings.destroy', $planning->id) }}"
      method="POST"
      class="d-inline">

    @csrf
    @method('DELETE')

    <button type="button"
            class="btn btn-danger btn-sm"
            onclick="confirmDelete({{ $planning->id }})"
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