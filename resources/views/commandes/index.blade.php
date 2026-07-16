@extends('layouts.app')


@section('content')


<h2>Liste des commandes</h2>


<a href="{{ route('commandes.create') }}">
    Ajouter une commande
</a>


<br><br>


<table border="1" cellpadding="10">


<tr>

<th>Code</th>

<th>Fournisseur</th>

<th>Demande Achat</th>

<th>Date OS</th>

<th>Durée travaux</th>

<th>Classe HSE</th>

<th>Montant HT</th>

<th>Mode Facturation</th>

<th>Mode Paiement</th>

<th>Garantie</th>

<th>Complexité</th>

<th>Statut</th>

<th>Actions</th>

</tr>


@foreach($commandes as $commande)


<tr>


<td>
{{ $commande->code }}
</td>


<td>

{{ $commande->fournisseur->nom ?? '' }}

</td>


<td>

{{ $commande->demandeAchat->code }}

</td>


<td>

{{ $commande->date_os }}

</td>


<td>

{{ $commande->duree_travaux }}

</td>


<td>

{{ $commande->classe_hse }}

</td>


<td>

{{ $commande->montant_ht }}

</td>


<td>

{{ $commande->mode_facturation }}

</td>


<td>

{{ $commande->mode_paiement }}

</td>


<td>

{{ $commande->duree_garantie }}

</td>


<td>

{{ $commande->complexite }}

</td>


<td>

{{ $commande->statut }}

</td>


<td>


<a href="{{ route('commandes.edit',$commande->id) }}">
Modifier
</a>


<form action="{{ route('commandes.destroy',$commande->id) }}"
      method="POST">

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


{{ $commandes->links() }}


@endsection