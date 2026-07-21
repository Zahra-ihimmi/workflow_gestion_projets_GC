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


<option value="Classe A"
@if($commande->classe_hse=="Classe A") selected @endif>
Classe A
</option>


<option value="Classe B"
@if($commande->classe_hse=="Classe B") selected @endif>
Classe B
</option>


<option value="Classe C"
@if($commande->classe_hse=="Classe C") selected @endif>
Classe C
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

<input type="number"
step="0.01"
name="mode_facturation"
value="{{ $commande->mode_facturation }}">


<br><br>



<label>Mode paiement</label>

<input type="number" step="0.01" name="mode_paiement" min="0"
value="{{ $commande->mode_paiement }}">



<br><br>


<label>Durée garantie</label>

<input type="number"
name="duree_garantie"
value="{{ $commande->duree_garantie }}">


<br><br>


<label>Complexité</label>

<select name="complexite">


<option value="low"
@if($commande->complexite=="low") selected @endif>
Faible
</option>


<option value="medium"
@if($commande->complexite=="medium") selected @endif>
Moyenne
</option>


<option value="high"
@if($commande->complexite=="high") selected @endif>
Elevée
</option>


</select>


<br><br>


<label>Statut</label>

<select name="statut">


<option value="hold"
@if($commande->statut=="hold") selected @endif>
hold
</option>


<option value="exécution"
@if($commande->statut=="exécution") selected @endif>
exécution
</option>


<option value="clôture"
@if($commande->statut=="clôture") selected @endif>
clôture
</option>


<option value="réception définitive"
@if($commande->statut=="réception définitive") selected @endif>
réception définitive
</option>


</select>


<br><br>


<button type="submit">

Modifier

</button>


</form>


@endsection