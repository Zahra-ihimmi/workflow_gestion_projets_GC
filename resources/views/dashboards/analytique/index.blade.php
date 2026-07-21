@extends('layouts.app')

@section('title', 'Dashboard Analytique')
@section('breadcrumb', 'Dashboard analytique')
@section('content')

<div class="page-header">

    <div>
        <h1 class="page-title">
            Dashboard Analytique
        </h1>

        <p class="page-subtitle">
            Analyse détaillée des projets, études, commandes et engagements
        </p>
    </div>

</div>


{{-- ========================================================= --}}
{{-- FILTRES --}}
{{-- ========================================================= --}}

<div class="card dashboard-filter-card">

    <div class="card-header">

        <div class="card-title">

            <i class="fa fa-filter"></i>

            Filtres d'analyse

        </div>

    </div>


    <div class="card-body">

        <form
            method="GET"
            action="{{ route('dashboard.analytique') }}"
        >

            <div class="row g-3">


                {{-- PROJET --}}

                <div class="col-md-3">

                    <label class="filter-label">
                        Projet
                    </label>

                    <select
                        name="projet_id"
                        class="form-control"
                    >

                        <option value="">
                            Tous les projets
                        </option>

                        @foreach($projets as $projet)

                            <option
                                value="{{ $projet->id }}"
                                {{ $projetId == $projet->id ? 'selected' : '' }}
                            >

                                {{ $projet->code }}
                                -
                                {{ $projet->intitule }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- CLIENT --}}

                <div class="col-md-3">

                    <label class="filter-label">
                        Client
                    </label>

                    <select
                        name="client"
                        class="form-control"
                    >

                        <option value="">
                            Tous les clients
                        </option>

                        @foreach($clients as $clientItem)

                            <option
                                value="{{ $clientItem }}"
                                {{ $client == $clientItem ? 'selected' : '' }}
                            >

                                {{ $clientItem }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- FOURNISSEUR --}}

                <div class="col-md-3">

                    <label class="filter-label">
                        Fournisseur
                    </label>

                    <select
                        name="fournisseur_id"
                        class="form-control"
                    >

                        <option value="">
                            Tous les fournisseurs
                        </option>

                        @foreach($fournisseurs as $fournisseur)

                            <option
                                value="{{ $fournisseur->id }}"
                                {{ $fournisseurId == $fournisseur->id ? 'selected' : '' }}
                            >

                                {{ $fournisseur->nom }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- PÉRIODE --}}

                <div class="col-md-3">

                    <label class="filter-label">
                        Période
                    </label>

                    <select
                        name="periode"
                        class="form-control"
                    >

                        <option
                            value="toutes"
                            {{ $periode == 'toutes' ? 'selected' : '' }}
                        >
                            Toutes les périodes
                        </option>

                        <option
                            value="mois_courant"
                            {{ $periode == 'mois_courant' ? 'selected' : '' }}
                        >
                            Mois en cours
                        </option>

                        <option
                            value="trimestre_courant"
                            {{ $periode == 'trimestre_courant' ? 'selected' : '' }}
                        >
                            Trimestre en cours
                        </option>

                        <option
                            value="annee_precedente"
                            {{ $periode == 'annee_precedente' ? 'selected' : '' }}
                        >
                            Année précédente
                        </option>

                        <option
                            value="annee_courante"
                            {{ $periode == 'annee_courante' ? 'selected' : '' }}
                        >
                            Année en cours
                        </option>

                        <option
                            value="annee_prochaine"
                            {{ $periode == 'annee_prochaine' ? 'selected' : '' }}
                        >
                            Année prochaine
                        </option>

                    </select>

                </div>

            </div>


            <div class="filter-actions mt-4">

                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <i class="fa fa-search"></i>

                    Appliquer

                </button>


                <a
                    href="{{ route('dashboard.analytique') }}"
                    class="btn btn-light"
                >

                    <i class="fa fa-refresh"></i>

                    Réinitialiser

                </a>

            </div>

        </form>

    </div>

</div>



{{-- ========================================================= --}}
{{-- KPI PRINCIPAUX --}}
{{-- ========================================================= --}}

<div class="row g-3 mt-3">


    {{-- TOTAL PROJETS --}}

    <div class="col-xl-3 col-md-6">

        <div class="analytics-kpi-card">

            <div class="analytics-kpi-icon">

                <i class="fa fa-folder-open"></i>

            </div>

            <div>

                <div class="analytics-kpi-label">
                    Projets analysés
                </div>

                <div class="analytics-kpi-value">
                    {{ $totalProjets }}
                </div>

            </div>

        </div>

    </div>


    {{-- BUDGET LB --}}

    <div class="col-xl-3 col-md-6">

        <div class="analytics-kpi-card">

            <div class="analytics-kpi-icon">

                <i class="fa fa-money"></i>

            </div>

            <div>

                <div class="analytics-kpi-label">
                    Budget LB
                </div>

                <div class="analytics-kpi-value">

                    {{ number_format(
                        $budgetTotal,
                        2,
                        ',',
                        ' '
                    ) }}

                    <span>DH</span>

                </div>

            </div>

        </div>

    </div>


    {{-- MONTANT ENGAGÉ --}}

    <div class="col-xl-3 col-md-6">

        <div class="analytics-kpi-card">

            <div class="analytics-kpi-icon">

                <i class="fa fa-file-text"></i>

            </div>

            <div>

                <div class="analytics-kpi-label">
                    Montant engagé
                </div>

                <div class="analytics-kpi-value">

                    {{ number_format(
                        $montantEngage,
                        2,
                        ',',
                        ' '
                    ) }}

                    <span>DH</span>

                </div>

            </div>

        </div>

    </div>


    {{-- BUDGET RESTANT --}}

    <div class="col-xl-3 col-md-6">

        <div class="analytics-kpi-card">

            <div class="analytics-kpi-icon">

                <i class="fa fa-pie-chart"></i>

            </div>

            <div>

                <div class="analytics-kpi-label">
                    Budget restant
                </div>

                <div class="analytics-kpi-value">

                    {{ number_format(
                        $budgetRestant,
                        2,
                        ',',
                        ' '
                    ) }}

                    <span>DH</span>

                </div>

            </div>

        </div>

    </div>

</div>



{{-- ========================================================= --}}
{{-- KPI OPÉRATIONNELS DU PROJET --}}
{{-- ========================================================= --}}

<div class="row g-3 mt-1">


    {{-- DA --}}

    <div class="col-xl-3 col-md-6">

        <div class="analytics-mini-card">

            <div class="mini-icon">
                <i class="fa fa-shopping-cart"></i>
            </div>

            <div>

                <span>
                    Demandes d'achat
                </span>

                <strong>
                    {{ $nombreDA }}
                </strong>

            </div>

        </div>

    </div>


    {{-- COMMANDES --}}

    <div class="col-xl-3 col-md-6">

        <div class="analytics-mini-card">

            <div class="mini-icon">
                <i class="fa fa-file-text-o"></i>
            </div>

            <div>

                <span>
                    Commandes
                </span>

                <strong>
                    {{ $nombreCommandes }}
                </strong>

            </div>

        </div>

    </div>


    {{-- PROJETS LANCÉS --}}

    <div class="col-xl-3 col-md-6">

        <div class="analytics-mini-card">

            <div class="mini-icon">
                <i class="fa fa-play-circle"></i>
            </div>

            <div>

                <span>
                    Projets lancés
                </span>

                <strong>
                    {{ $projetsLances }}
                </strong>

            </div>

        </div>

    </div>


    {{-- PROJETS À LANCER --}}

    <div class="col-xl-3 col-md-6">

        <div class="analytics-mini-card">

            <div class="mini-icon">
                <i class="fa fa-clock-o"></i>
            </div>

            <div>

                <span>
                    Projets à lancer
                </span>

                <strong>
                    {{ $projetsALancer }}
                </strong>

            </div>

        </div>

    </div>

</div>



{{-- ========================================================= --}}
{{-- TAUX D'ENGAGEMENT --}}
{{-- ========================================================= --}}

<div class="row g-3 mt-3">


    <div class="col-lg-6">

        <div class="card analytics-panel">

            <div class="card-header">

                <div class="card-title">

                    <i class="fa fa-line-chart"></i>

                    Taux d'engagement budgétaire

                </div>

            </div>


            <div class="card-body">

                <div class="progress-container">

                    <div class="progress-info">

                        <span>
                            Budget engagé
                        </span>

                        <strong>
                            {{ number_format(
                                $tauxEngagement,
                                1,
                                ',',
                                ' '
                            ) }} %
                        </strong>

                    </div>


                    <div class="progress">

                        <div
                            class="progress-bar"
                            role="progressbar"
                            style="width: {{ min($tauxEngagement, 100) }}%"
                        >
                        </div>

                    </div>

                </div>


                <div class="budget-summary mt-4">

                    <div>

                        <span>
                            Budget LB
                        </span>

                        <strong>

                            {{ number_format(
                                $budgetTotal,
                                2,
                                ',',
                                ' '
                            ) }}

                            DH

                        </strong>

                    </div>


                    <div>

                        <span>
                            Engagé
                        </span>

                        <strong>

                            {{ number_format(
                                $montantEngage,
                                2,
                                ',',
                                ' '
                            ) }}

                            DH

                        </strong>

                    </div>


                    <div>

                        <span>
                            Restant
                        </span>

                        <strong>

                            {{ number_format(
                                $budgetRestant,
                                2,
                                ',',
                                ' '
                            ) }}

                            DH

                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- RÉPARTITION TYPES --}}

    <div class="col-lg-6">

        <div class="card analytics-panel">

            <div class="card-header">

                <div class="card-title">

                    <i class="fa fa-pie-chart"></i>

                    Répartition du portefeuille

                </div>

            </div>


            <div class="card-body">

                <canvas
                    id="typeProjetChart"
                    height="180"
                >
                </canvas>

            </div>

        </div>

    </div>

</div>



{{-- ========================================================= --}}
{{-- ALERTES --}}
{{-- ========================================================= --}}

<div class="row g-3 mt-3">


    {{-- PROJETS EN RETARD --}}

    <div class="col-lg-6">

        <div class="card analytics-panel">

            <div class="card-header">

                <div class="card-title">

                    <i class="fa fa-exclamation-triangle"></i>

                    Études en retard

                </div>

                <span class="badge bg-danger">

                    {{ $projetsEnRetard }}

                </span>

            </div>


            <div class="card-body p-0">

                @if($listeProjetsEnRetard->count() > 0)

                    <div class="table-responsive">

                        <table class="table table-hover mb-0">

                            <thead>

                                <tr>

                                    <th>
                                        Projet
                                    </th>

                                    <th>
                                        Date objectif
                                    </th>

                                    <th>
                                        Statut
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($listeProjetsEnRetard as $lb)

                                    <tr>

                                        <td>

                                            <strong>
                                                {{ $lb->code }}
                                            </strong>

                                            <br>

                                            <small>
                                                {{ $lb->intitule }}
                                            </small>

                                        </td>

                                        <td>

                                            @if($lb->date_objective)

                                                {{ \Carbon\Carbon::parse(
                                                    $lb->date_objective
                                                )->format('d/m/Y') }}

                                            @else

                                                -

                                            @endif

                                        </td>

                                        <td>

                                            <span class="badge bg-danger">

                                                En retard

                                            </span>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="empty-state">

                        <i class="fa fa-check-circle"></i>

                        <p>
                            Aucun projet en retard.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>



    {{-- PROJETS À LANCER --}}

    <div class="col-lg-6">

        <div class="card analytics-panel">

            <div class="card-header">

                <div class="card-title">

                    <i class="fa fa-hourglass-start"></i>

                    Études à lancer

                </div>

                <span class="badge bg-warning">

                    {{ $projetsALancer }}

                </span>

            </div>


            <div class="card-body p-0">

                @if($listeProjetsALancer->count() > 0)

                    <div class="table-responsive">

                        <table class="table table-hover mb-0">

                            <thead>

                                <tr>

                                    <th>
                                        Projet
                                    </th>

                                    <th>
                                        Date objectif
                                    </th>

                                    <th>
                                        Statut
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach(
                                    $listeProjetsALancer->take(5)
                                    as $lb
                                )

                                    <tr>

                                        <td>

                                            <strong>
                                                {{ $lb->code }}
                                            </strong>

                                            <br>

                                            <small>
                                                {{ $lb->intitule }}
                                            </small>

                                        </td>

                                        <td>

                                            @if($lb->date_objective)

                                                {{ \Carbon\Carbon::parse(
                                                    $lb->date_objective
                                                )->format('d/m/Y') }}

                                            @else

                                                -

                                            @endif

                                        </td>

                                        <td>

                                            <span class="badge bg-warning">

                                                À lancer

                                            </span>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="empty-state">

                        <i class="fa fa-check-circle"></i>

                        <p>
                            Tous les projets sont lancés.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>



{{-- ========================================================= --}}
{{-- TABLEAU DÉTAILLÉ --}}
{{-- ========================================================= --}}

<div class="card analytics-panel mt-3">

    <div class="card-header">

        <div class="card-title">

            <i class="fa fa-list"></i>

            Détail des projets analysés

        </div>

    </div>


    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover">

                <thead>

                    <tr>

                        <th>
                            Code
                        </th>

                        <th>
                            Projet
                        </th>

                        <th>
                            Type
                        </th>

                        <th>
                            Client
                        </th>

                        <th>
                            Budget LB
                        </th>

                        <th>
                            DA
                        </th>

                        <th>
                            CMD
                        </th>

                        <th>
                            Montant engagé
                        </th>

                        <th>
                            Date objectif
                        </th>

                        <th>
                            Statut
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($lignesBudgetaires as $lb)

                        @php

                            $projetDAs =
                                $lb->demandesAchats;

                            $projetCommandes =
                                $projetDAs
                                    ->map(
                                        fn($da) =>
                                        $da->commande
                                    )
                                    ->filter();

                            $projetEngage =
                                $projetCommandes
                                    ->sum('montant_ht');

                        @endphp


                        <tr>

                            <td>

                                <strong>
                                    {{ $lb->code }}
                                </strong>

                            </td>


                            <td>

                                {{ $lb->intitule }}

                            </td>


                            <td>

                                <span class="badge">

                                    {{ $lb->type }}

                                </span>

                            </td>


                            <td>

                                {{ $lb->client ?? '-' }}

                            </td>


                            <td>

                                {{ number_format(
                                    $lb->montant_estimatif,
                                    2,
                                    ',',
                                    ' '
                                ) }}

                                DH

                            </td>


                            <td>

                                {{ $projetDAs->count() }}

                            </td>


                            <td>

                                {{ $projetCommandes->count() }}

                            </td>


                            <td>

                                {{ number_format(
                                    $projetEngage,
                                    2,
                                    ',',
                                    ' '
                                ) }}

                                DH

                            </td>


                            <td>

                                @if($lb->date_objective)

                                    {{ \Carbon\Carbon::parse(
                                        $lb->date_objective
                                    )->format('d/m/Y') }}

                                @else

                                    -

                                @endif

                            </td>


                            <td>

                                {{ $lb->statut ?? '-' }}

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="10"
                                class="text-center"
                            >

                                Aucun projet trouvé.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>



@endsection



{{-- ========================================================= --}}
{{-- CHART.JS --}}
{{-- ========================================================= --}}

@push('scripts')

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const ctx =
            document
                .getElementById(
                    'typeProjetChart'
                );

        if (!ctx) {
            return;
        }


        new Chart(
            ctx,
            {

                type: 'doughnut',

                data: {

                    labels: [
                        'CAPEX',
                        'OPEX',
                        'PDR'
                    ],

                    datasets: [

                        {

                            data: [

                                {{ $nombreCapex }},

                                {{ $nombreOpex }},

                                {{ $nombrePdr }}

                            ]

                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    plugins: {

                        legend: {

                            position: 'bottom'

                        }

                    }

                }

            }

        );

    }

);

</script>

@endpush