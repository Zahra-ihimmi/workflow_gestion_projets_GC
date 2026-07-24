@extends('layouts.app')
@section('breadcrumb', 'Liste des décomptes')
@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Liste des décomptes</h2>

        <a href="{{ route('decomptes.create') }}" class="btn btn-primary">
            Ajouter un décompte
        </a>

    </div>

<br><br>

<table border="1" cellpadding="10">

<tr>

<th>Code</th>

<th>Commande</th>

<th>Date</th>

<th>Désignation</th>

<th>Quantité</th>

<th>N° SAP</th>

<th>N° Réception SAP</th>

<th>Statut</th>

<th>Actions</th>

</tr>

@foreach($decomptes as $decompte)

<tr>

<td>{{ $decompte->code }}</td>

<td>{{ $decompte->commande->code }}</td>

<td>{{ $decompte->date }}</td>

<td>{{ $decompte->designation }}</td>

<td>{{ $decompte->quantite_attachee }}</td>

<td>{{ $decompte->num_ses }}</td>

<td>{{ $decompte->num_rec_ses }}</td>

<td>{{ $decompte->statut_validation }}</td>

<td>

<a href="{{ route('decomptes.edit',$decompte->id) }}"
class="btn btn-success btn-sm"
   title="Modifier">
    <i class="fa-solid fa-pen-to-square"></i>
</a>

<form id="delete-form-{{ $decompte->id }}"
      action="{{ route('decomptes.destroy', $decompte->id) }}"
      method="POST"
      class="d-inline">

    @csrf
    @method('DELETE')

    <button type="button"
            class="btn btn-danger btn-sm"
            onclick="confirmDelete({{ $decompte->id }})"
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