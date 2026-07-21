@extends('layouts.app')


@section('content')


<h2>Ajouter une commande</h2>


<form action="{{ route('commandes.store') }}" method="POST">

@csrf



<label>Fournisseur</label>

<select name="fournisseur_id">

    <option value="">Choisir un fournisseur</option>

    @foreach($fournisseurs as $fournisseur)

        <option value="{{ $fournisseur->id }}">
            {{ $fournisseur->nom }}
        </option>

    @endforeach

</select>


<br><br>


<label>Demande Achat</label>

<select name="demande_achat_id">

    <option value="">Choisir une demande d'achat</option>

    @foreach($demandeAchats as $da)

        <option value="{{ $da->id }}">
            {{ $da->code }}
        </option>

    @endforeach

</select>


<br><br>


<label>Date OS</label>

<input type="date" name="date_os">


<br><br>


<label>Durée travaux</label>

<input type="number" name="duree_travaux" min="0">


<br><br>


<label>Classe HSE</label>

<select name="classe_hse">

    <option value="">Choisir</option>

    <option value="Classe A">A</option>

    <option value="Classe B">B</option>

    <option value="Classe C">C</option>

</select>


<br><br>


<label>Montant HT</label>

<input type="number" step="0.01" name="montant_ht" min="0">


<br><br>


<label>Mode facturation</label>

<input type="number" step="0.01" name="mode_facturation" min="0">



<br><br>


<label>Mode paiement</label>

<input type="number" step="0.01" name="mode_paiement" min="0">


<br><br>




<label>Durée garantie</label>

<input type="number" name="duree_garantie">


<br><br>


<label>Complexité</label>

<select name="complexite">

    <option value="">Choisir</option>

    <option value="low">low</option>

    <option value="high">high</option>

    <option value="medium">medium</option>

</select>


<br><br>


<label>Statut</label>

<select name="statut">

    <option value="">Choisir</option>
    
    <option value="hold">hold</option>
    <option value="exécution">exécution</option>
    <option value="clôture">clôture</option>
    <option value="réception définitive">réception définitive</option>



</select>


<br><br>


<button type="submit">

Ajouter

</button>


</form>


@endsection