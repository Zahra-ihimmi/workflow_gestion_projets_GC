@extends('layouts.app')
@section('breadcrumb', 'Liste des Véhicules')
@section('content')

<h2>Liste des Véhicules</h2>

<a href="{{ route('vehicules.create') }}">

Ajouter un Véhicule

</a>

<br><br>

<table border="1">

<tr>

<th>Fournisseur</th>

<th>Type</th>

<th>Type habilitation</th>

<th>Date début</th>

<th>Date fin</th>

<th>Actions</th>

</tr>

@foreach($vehicules as $vehicule)

<tr>

<td>{{ $vehicule->fournisseur->nom }}</td>

<td>{{ $vehicule->type }}</td>

<td>{{ $vehicule->type_habilitation }}</td>

<td>{{ $vehicule->date_debut }}</td>

<td>{{ $vehicule->date_fin }}</td>

<td>

<a href="{{ route('vehicules.edit',$vehicule->id) }}"
class="btn btn-success btn-sm"
   title="Modifier">
    <i class="fa-solid fa-pen-to-square"></i>

</a>

<form id="delete-form-{{ $vehicule->id }}"
      action="{{ route('vehicules.destroy', $vehicule   ->id) }}"
      method="POST"
      class="d-inline">

    @csrf
    @method('DELETE')

    <button type="button"
            class="btn btn-danger btn-sm"
            onclick="confirmDelete({{ $vehicule->id }})"
            title="Supprimer">
        <i class="fa-solid fa-trash"></i>
    </button>

</form>

</td>

</tr>

@endforeach

</table>



@endsection