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

    <option value="A">A</option>

    <option value="B">B</option>

    <option value="C">C</option>

</select>


<br><br>


<label>Montant HT</label>

<input type="number" step="0.01" name="montant_ht" min="0">


<br><br>


<label>Mode facturation</label>

<select name="mode_facturation">

    <option value="">Choisir</option>

    <option value="Forfait">Forfait</option>

    <option value="Mensuel">Mensuel</option>

    <option value="Avancement">Avancement</option>

</select>


<br><br>


<label>Mode paiement</label>

<select name="mode_paiement">

    <option value="">Choisir</option>

    <option value="Virement">Virement</option>

    <option value="Chèque">Chèque</option>

    <option value="Espèce">Espèce</option>

</select>


<br><br>


<label>Durée garantie</label>

<input type="number" name="duree_garantie">


<br><br>


<label>Complexité</label>

<select name="complexite">

    <option value="">Choisir</option>

    <option value="Faible">Faible</option>

    <option value="Moyenne">Moyenne</option>

    <option value="Elevée">Elevée</option>

</select>


<br><br>


<label>Statut</label>

<select name="statut">

    <option value="">Choisir</option>

    <option value="Préparation">Préparation</option>

    <option value="En cours">En cours</option>

    <option value="Terminé">Terminé</option>

    <option value="Suspendu">Suspendu</option>

</select>


<br><br>


<button type="submit">

Ajouter

</button>


</form>


@endsection