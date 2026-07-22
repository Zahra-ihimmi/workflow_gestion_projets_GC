@extends('layouts.app')
@section('breadcrumb', 'Liste des Fournisseurs')
@section('content')

<h2>Liste des Fournisseurs</h2>

<a href="{{ route('fournisseurs.create') }}">

Ajouter un Fournisseur

</a>

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

<a href="{{ route('fournisseurs.edit',$fournisseur->id) }}">

Modifier

</a>

<form action="{{ route('fournisseurs.destroy',$fournisseur->id) }}" method="POST">

@csrf

@method('DELETE')

<button
    class="btn btn-danger btn-sm"
                            onclick="return confirm('Supprimer ce fournisseur ?')">

Supprimer

</button>

</form>

</td>

</tr>

@endforeach

</table>


@endsection