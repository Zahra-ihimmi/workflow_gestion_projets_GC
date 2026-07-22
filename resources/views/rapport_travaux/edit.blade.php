@extends('layouts.app')

@section('breadcrumb', 'Modifier un Rapport de Travaux')

@section('content')

<h2>Modifier un Rapport de Travaux</h2>

<form
    action="{{ route('rapport-travaux.update', $rapport->id) }}"
    method="POST">

    @csrf
    @method('PUT')


    {{-- Commande --}}

    <label>
        Commande
    </label>

    <select name="commande_id">

        @foreach($commandes as $commande)

            <option
                value="{{ $commande->id }}"
                {{ $commande->id == $rapport->commande_id ? 'selected' : '' }}>

                {{ $commande->code }}

            </option>

        @endforeach

    </select>


    <br><br>


    {{-- Date --}}

    <label>
        Date
    </label>

    <input
        type="date"
        name="date"
        value="{{ $rapport->date }}">


    <br><br>


    {{-- CIN Rapporteur --}}

    <label>
        CIN du rapporteur
    </label>

    <input
        type="text"
        name="cin_reporteur"
        value="{{ $rapport->cin_reporteur }}"
        placeholder="Ex : AB123456">


    <br><br>


    {{-- Météo matin --}}

    <label>
        Météo du matin
    </label>

    <input
        type="text"
        name="meteo_matin"
        value="{{ $rapport->meteo_matin }}"
        placeholder="Ex : Ensoleillé, Nuageux, Pluvieux">


    <br><br>


    {{-- Météo soir --}}

    <label>
        Météo du soir
    </label>

    <input
        type="text"
        name="meteo_soir"
        value="{{ $rapport->meteo_soir }}"
        placeholder="Ex : Ensoleillé, Nuageux, Pluvieux">


    <br><br>


    {{-- Ecart HSE --}}

    <label>
        Ecart HSE
    </label>

    <select name="ecart_hse">

        <option
            value="Non"
            {{ $rapport->ecart_hse == 'Non' ? 'selected' : '' }}>

            Non

        </option>

        <option
            value="Oui"
            {{ $rapport->ecart_hse == 'Oui' ? 'selected' : '' }}>

            Oui

        </option>

    </select>


    <br><br>


    {{-- Ecart Qualité --}}

    <label>
        Ecart Qualité
    </label>

    <select name="ecart_qualite">

        <option
            value="Non"
            {{ $rapport->ecart_qualite == 'Non' ? 'selected' : '' }}>

            Non

        </option>

        <option
            value="Oui"
            {{ $rapport->ecart_qualite == 'Oui' ? 'selected' : '' }}>

            Oui

        </option>

    </select>


    <br><br>


    <button>
        Modifier
    </button>

</form>

@endsection