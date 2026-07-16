@extends('layouts.app')

@section('content')

<h2>Modifier un Fournisseur</h2>

<form action="{{ route('fournisseurs.update',$fournisseur->id) }}" method="POST">

@csrf

@method('PUT')

<label>ID Ariba</label>

<input
type="text"
name="id_ariba"
value="{{ $fournisseur->id_ariba }}">

<br><br>

<label>Nom</label>

<input
type="text"
name="nom"
value="{{ $fournisseur->nom }}">

<br><br>

<label>Logo</label>

<input
type="text"
name="logo"
value="{{ $fournisseur->logo }}">

<br><br>

<label>Lien Web</label>

<input
type="url"
name="lien_web"
value="{{ $fournisseur->lien_web }}">

<br><br>

<button>

Modifier

</button>

</form>

@endsection