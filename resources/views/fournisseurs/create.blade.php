@extends('layouts.app')

@section('content')

<h2>Ajouter un Fournisseur</h2>

<form action="{{ route('fournisseurs.store') }}" method="POST">

@csrf

<label>ID Ariba</label>

<input
type="text"
name="id_ariba">

<br><br>

<label>Nom</label>

<input
type="text"
name="nom">

<br><br>

<label>Logo</label>

<input
type="text"
name="logo">

<br><br>

<label>Lien Web</label>

<input
type="url"
name="lien_web">

<br><br>

<button>

Ajouter

</button>

</form>

@endsection