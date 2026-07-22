@extends('layouts.app')
@section('breadcrumb', 'Liste des bordureaux de Prix')
@section('content')

<h2>Liste des Prix</h2>

<a href="{{ route('prix.create') }}">
    Ajouter un prix
</a>

<br><br>

<table border="1">

<tr>

    <th>Code</th>

    <th>Commande</th>

    <th>Désignation</th>

    <th>Quantité</th>

    <th>Prix Unitaire</th>

    <th>Actions</th>

</tr>

@foreach($prix as $p)

<tr>

    <td>{{ $p->code }}</td>

    <td>{{ $p->commande->code }}</td>

    <td>{{ $p->designation }}</td>

    <td>{{ $p->quantite }}</td>

    <td>{{ $p->prix_unitaire }}</td>

    <td>

        <a href="{{ route('prix.edit',$p->id) }}">
            Modifier
        </a>

        <form action="{{ route('prix.destroy',$p->id) }}" method="POST">

            @csrf

            @method('DELETE')

            <button type="submit">

                Supprimer

            </button>

        </form>

    </td>

</tr>

@endforeach

</table>



@endsection