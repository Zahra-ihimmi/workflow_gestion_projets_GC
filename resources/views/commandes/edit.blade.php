@extends('layouts.app')


@section('content')


<h2>Modifier une commande</h2>


<form action="{{ route('commandes.update',$commande->id) }}" method="POST">


@csrf

@method('PUT')



<label>Code</label>

<input type="text"
name="code"
value="{{ $commande->code }}">


<br><br>



<label>Fournisseur</label>

<select name="fournisseur_id">


@foreach($fournisseurs as $fournisseur)

<option value="{{ $fournisseur->id }}"

@if($commande->fournisseur_id == $fournisseur->id)

selected

@endif

>

{{ $fournisseur->nom }}

</option>

@endforeach


</select>


<br><br>



<label>Demande Achat</label>

<select name="demande_achat_id">


@foreach($demandeAchats as $da)

<option value="{{ $da->id }}"

@if($commande->demande_achat_id == $da->id)

selected

@endif

>

{{ $da->code }}

</option>

@endforeach


</select>



<br><br>


<label>Date OS</label>

<input type="date"
name="date_os"
value="{{ $commande->date_os }}">


<br><br>


<label>Durée travaux</label>

<input type="number"
name="duree_travaux"
value="{{ $commande->duree_travaux }}">


<br><br>


<label>Classe HSE</label>

<select name="classe_hse">


<option value="A"
@if($commande->classe_hse=="A") selected @endif>
A
</option>


<option value="B"
@if($commande->classe_hse=="B") selected @endif>
B
</option>


<option value="C"
@if($commande->classe_hse=="C") selected @endif>
C
</option>


</select>


<br><br>


<label>Montant HT</label>

<input type="number"
step="0.01"
name="montant_ht"
value="{{ $commande->montant_ht }}">


<br><br>


<label>Mode facturation</label>

<select name="mode_facturation">


<option value="Forfait"
@if($commande->mode_facturation=="Forfait") selected @endif>
Forfait
</option>


<option value="Mensuel"
@if($commande->mode_facturation=="Mensuel") selected @endif>
Mensuel
</option>


<option value="Avancement"
@if($commande->mode_facturation=="Avancement") selected @endif>
Avancement
</option>


</select>


<br><br>


<label>Mode paiement</label>

<select name="mode_paiement">


<option value="Virement"
@if($commande->mode_paiement=="Virement") selected @endif>
Virement
</option>


<option value="Chèque"
@if($commande->mode_paiement=="Chèque") selected @endif>
Chèque
</option>


<option value="Espèce"
@if($commande->mode_paiement=="Espèce") selected @endif>
Espèce
</option>


</select>


<br><br>


<label>Durée garantie</label>

<input type="number"
name="duree_garantie"
value="{{ $commande->duree_garantie }}">


<br><br>


<label>Complexité</label>

<select name="complexite">


<option value="Faible"
@if($commande->complexite=="Faible") selected @endif>
Faible
</option>


<option value="Moyenne"
@if($commande->complexite=="Moyenne") selected @endif>
Moyenne
</option>


<option value="Elevée"
@if($commande->complexite=="Elevée") selected @endif>
Elevée
</option>


</select>


<br><br>


<label>Statut</label>

<select name="statut">


<option value="Préparation"
@if($commande->statut=="Préparation") selected @endif>
Préparation
</option>


<option value="En cours"
@if($commande->statut=="En cours") selected @endif>
En cours
</option>


<option value="Terminé"
@if($commande->statut=="Terminé") selected @endif>
Terminé
</option>


<option value="Suspendu"
@if($commande->statut=="Suspendu") selected @endif>
Suspendu
</option>


</select>


<br><br>


<button type="submit">

Modifier

</button>


</form>


@endsection