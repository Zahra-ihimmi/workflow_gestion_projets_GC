@extends('layouts.app')


@section('content')


<h2>Modifier une demande d'achat</h2>


<form action="{{ route('demande-achats.update',$demandeAchat->id) }}"
      method="POST">


@csrf

@method('PUT')


<label>Code</label>

<input type="text"
name="code"
value="{{ $demandeAchat->code }}">


<br><br>


<label>ID Ligne Budgétaire</label>

<input type="number"
name="ligne_budgetaire_id"
value="{{ $demandeAchat->ligne_budgetaire_id }}">


<br><br>


<label>ID Utilisateur</label>

<input type="number"
name="utilisateur_id"
value="{{ $demandeAchat->utilisateur_id }}">


<br><br>


<label>Estimation</label>

<input type="number"
step="0.01"
name="estimation"
value="{{ $demandeAchat->estimation }}">


<br><br>


<label>Date saisi</label>

<input type="date"
name="date_saisi"
value="{{ $demandeAchat->date_saisi }}">


<br><br>


<label>Acheteur</label>

<input type="text"
name="acheteur"
value="{{ $demandeAchat->acheteur }}">


<br><br>


<label>Type projet</label>

<input type="text"
name="type_projet"
value="{{ $demandeAchat->type_projet }}">


<br><br>


<label>Catégorie</label>

<input type="text"
name="categorie"
value="{{ $demandeAchat->categorie }}">


<br><br>


<label>Statut</label>

<input type="text"
name="statut"
value="{{ $demandeAchat->statut }}">


<br><br>


<button>

Modifier

</button>


</form>


@endsection