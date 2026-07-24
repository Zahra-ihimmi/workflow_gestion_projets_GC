@extends('layouts.app')
@section('breadcrumb', 'Liste des Fournisseurs')
@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Liste des Fournisseurs</h2>

        <a href="{{ route('fournisseurs.create') }}" class="btn btn-primary">
            Ajouter un Fournisseur
        </a>

    </div>

<br><br>

<table border="1">

<tr>

<th>ID Ariba</th>

<th>Nom</th>

<th>Logo</th>

<th>Lien Web</th>

<th>Actions</th>

</tr>

@foreach($fournisseurs as $fournisseur)

<tr>

<td>{{ $fournisseur->id_ariba }}</td>

<td>{{ $fournisseur->nom }}</td>

<td>{{ $fournisseur->logo }}</td>

<td>

@if($fournisseur->lien_web)

<a href="{{ $fournisseur->lien_web }}" target="_blank">

{{ $fournisseur->lien_web }}

</a>

@endif

</td>

<td>

<a href="{{ route('fournisseurs.edit',$fournisseur->id) }}"
class="btn btn-success btn-sm"
   title="Modifier">
    <i class="fa-solid fa-pen-to-square"></i>
</a>

<form id="delete-form-{{ $fournisseur->id }}"
      action="{{ route('fournisseurs.destroy', $fournisseur->id) }}"
      method="POST"
      class="d-inline">

    @csrf
    @method('DELETE')

    <button type="button"
            class="btn btn-danger btn-sm"
            onclick="confirmDelete({{ $fournisseur->id }})"
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