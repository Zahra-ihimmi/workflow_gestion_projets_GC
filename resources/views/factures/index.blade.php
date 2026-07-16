@extends('layouts.app')

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

<a href="{{ route('factures.edit',$facture->id) }}">

Modifier

</a>

<form action="{{ route('factures.destroy',$facture->id) }}" method="POST">

@csrf

@method('DELETE')

<button>

Supprimer

</button>

</form>

</td>

</tr>

@endforeach

</table>

<br>

{{ $factures->links() }}

@endsection