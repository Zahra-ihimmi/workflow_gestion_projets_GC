@extends('layouts.app')


@section('content')


<h2>Liste des demandes d'achat</h2>


<a href="{{ route('demande-achats.create') }}">
    Ajouter une demande d'achat
</a>


<br><br>


<table border="1" cellpadding="10">


<tr>

<th>Code</th>

<th>LB</th>

<th>Utilisateur</th>

<th>Estimation</th>

<th>Date saisi</th>

<th>Acheteur</th>

<th>Type projet</th>

<th>Catégorie</th>

<th>Statut</th>

<th>Actions</th>

</tr>



@foreach($demandeAchats as $da)


<tr>

<td>
{{ $da->code }}
</td>


<td>
{{ $da->ligneBudgetaire->intitule }}
</td>


<td>
{{ $da->utilisateur->nom }}
{{ $da->utilisateur->prenom }}
</td>


<td>
{{ $da->estimation }}
</td>


<td>
{{ $da->date_saisi }}
</td>


<td>
{{ $da->acheteur }}
</td>


<td>
{{ $da->type_projet }}
</td>


<td>
{{ $da->categorie }}
</td>


<td>
{{ $da->statut }}
</td>


<td>

<a href="{{ route('demande-achats.edit',$da->id) }}">
Modifier
</a>


<form action="{{ route('demande-achats.destroy',$da->id) }}" method="POST">

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


<br>


{{ $demandeAchats->links() }}


@endsection