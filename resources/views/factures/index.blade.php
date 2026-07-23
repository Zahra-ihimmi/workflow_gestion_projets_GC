@extends('layouts.app')
@section('breadcrumb', 'Liste des Factures')
@section('content')

<h2>Liste des Factures</h2>

<a href="{{ route('factures.create') }}">

Ajouter une Facture

</a>

<br><br>

<table border="1">

<tr>

<th>Code</th>

<th>Décompte</th>

<th>Date dépôt</th>

<th>Montant</th>

<th>Actions</th>

</tr>

@foreach($factures as $facture)

<tr>

<td>{{ $facture->code }}</td>

<td>{{ $facture->decompte->code }}</td>

<td>{{ $facture->date_depot }}</td>

<td>{{ $facture->montant }}</td>

<td>

<a href="{{ route('factures.edit',$facture->id) }}"
class="btn btn-success btn-sm"
   title="Modifier">
    <i class="fa-solid fa-pen-to-square"></i>
</a>
</a>

<form id="delete-form-{{ $facture->id }}"
      action="{{ route('factures.destroy', $facture->id) }}"
      method="POST"
      class="d-inline">

    @csrf
    @method('DELETE')

    <button type="button"
            class="btn btn-danger btn-sm"
            onclick="confirmDelete({{ $facture->id }})"
            title="Supprimer">
    <i class="fa-solid fa-trash"></i>
    </button>

</form>
</td>

</tr>

@endforeach

</table>



@endsection