@extends('layouts.app')

@section('content')

<h2>Liste des Rapports de Travaux</h2>

<a href="{{ route('rapport-travaux.create') }}">
Ajouter un rapport
</a>

<br><br>

<table border="1">

<tr>

<th>Code</th>

<th>Commande</th>

<th>Date</th>

<th>Ecart HSE</th>

<th>Ecart Qualité</th>

<th>Actions</th>

</tr>

@foreach($rapports as $rapport)

<tr>

<td>{{ $rapport->code }}</td>

<td>{{ $rapport->commande->code }}</td>

<td>{{ $rapport->date }}</td>

<td>{{ $rapport->ecart_hse }}</td>

<td>{{ $rapport->ecart_qualite }}</td>

<td>

<a href="{{ route('rapport-travaux.edit',$rapport->id) }}">
Modifier
</a>

<form action="{{ route('rapport-travaux.destroy',$rapport->id) }}" method="POST">

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

{{ $rapports->links() }}

@endsection