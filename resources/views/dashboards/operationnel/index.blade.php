@extends('layouts.app')

@section('title', 'Dashboard Opérationnel')
@section('breadcrumb', 'Dashboard opérationnel')
@section('content')

<style>

    :root {
        --steel: #2C4A6B;
        --steel-dark: #1B2E44;
        --steel-soft: #EAF0F6;
        --safety: #E2611C;
        --safety-soft: #FDECE1;
        --teal: #2F8C7A;
        --teal-soft: #E3F2EE;
        --amber: #D19A1D;
        --amber-soft: #FBF1DC;
        --ink: #17212B;
        --ink-soft: #6b7280;
        --ink-faint: #9ca3af;
        --border: #e9ecf1;
        --bg-page: #F5F7FA;
        --card-bg: #ffffff;
        --input-border: #d1d5db;
        --row-border: #eeeeee;

        --badge-exec-bg: #dcfce7;
        --badge-exec-color: #166534;
        --badge-hold-bg: #fef3c7;
        --badge-hold-color: #92400e;
        --badge-cloture-bg: #dbeafe;
        --badge-cloture-color: #1e40af;
        --badge-reception-bg: #ede9fe;
        --badge-reception-color: #5b21b6;
        --badge-retard-bg: #fee2e2;
        --badge-retard-color: #991b1b;
    }

    /*
    |--------------------------------------------------------------------------
    | DARK MODE
    |--------------------------------------------------------------------------
    | layouts.app utilise <html data-theme="light|dark">, basculé par js/app.js.
    */

    html[data-theme="dark"] .operational-dashboard {
        --steel: #6f9bc7;
        --steel-dark: #4a7099;
        --steel-soft: rgba(111, 155, 199, .16);
        --safety: #ff8a4d;
        --safety-soft: rgba(255, 138, 77, .14);
        --teal: #5fc2ab;
        --teal-soft: rgba(95, 194, 171, .14);
        --amber: #f0c04b;
        --amber-soft: rgba(240, 192, 75, .14);
        --ink: #eef1f5;
        --ink-soft: #a9b4c2;
        --ink-faint: #7c8797;
        --border: #2a3542;
        --bg-page: #0f151d;
        --card-bg: #171f29;
        --input-border: #3a4552;
        --row-border: #263140;

        --badge-exec-bg: rgba(34, 197, 94, .18);
        --badge-exec-color: #6ee7a1;
        --badge-hold-bg: rgba(245, 158, 11, .18);
        --badge-hold-color: #fbd077;
        --badge-cloture-bg: rgba(59, 130, 246, .18);
        --badge-cloture-color: #93c1fd;
        --badge-reception-bg: rgba(139, 92, 246, .18);
        --badge-reception-color: #c4b1fb;
        --badge-retard-bg: rgba(239, 68, 68, .18);
        --badge-retard-color: #fca5a5;
    }

    .operational-dashboard {
        padding-bottom: 40px;
        background: var(--bg-page);
        width: 100%;
        max-width: 100%;
        flex: 1 1 100%;
        align-self: stretch;
        box-sizing: border-box;
        transition: background-color .15s ease, color .15s ease;
    }

    .operational-dashboard * {
        box-sizing: border-box;
    }

    .operational-dashboard > form {
        width: 100%;
        display: block;
    }

    .dashboard-header {
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    .dashboard-header .header-text {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .dashboard-header .header-mark {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--steel), var(--steel-dark));
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(27,46,68,.25);
    }

    .dashboard-header h1 {
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 3px;
        color: var(--ink);
        letter-spacing: -.01em;
    }

    .dashboard-header p {
        color: var(--ink-soft);
        margin: 0;
        font-size: 14px;
    }

    /* FILTRES */

    .filter-card {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 20px 22px;
        margin-bottom: 25px;
        box-shadow: 0 3px 15px rgba(17,24,39,.05);
        border: 1px solid var(--border);
        width: 100%;
    }

    .filter-grid {
        display: grid;
        grid-template-columns:
            repeat(4, minmax(0, 1fr));
        gap: 15px;
        align-items: end;
        width: 100%;
    }

    .filter-group label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12.5px;
        font-weight: 600;
        margin-bottom: 7px;
        color: var(--ink-soft);
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .filter-group select {
        width: 100%;
        height: 42px;
        border: 1px solid var(--input-border);
        border-radius: 8px;
        padding: 0 12px;
        background: var(--card-bg);
        font-size: 13.5px;
        color: var(--ink);
        transition: border-color .15s ease;
    }

    .filter-group select:focus {
        outline: none;
        border-color: var(--steel);
        box-shadow: 0 0 0 3px rgba(44,74,107,.12);
    }

    .btn-filter {
        height: 42px;
        border: none;
        border-radius: 8px;
        padding: 0 24px;
        font-weight: 600;
        font-size: 13.5px;
        cursor: pointer;
        background: var(--steel);
        color: #fff;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background .15s ease, transform .1s ease;
    }

    .btn-filter:hover {
        background: var(--steel-dark);
    }

    .btn-filter:active {
        transform: translateY(1px);
    }

    /* SECTIONS */

    .dashboard-section {
        margin-bottom: 32px;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--border);
    }

    .section-header .icon-badge {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--steel-soft);
        color: var(--steel);
        flex-shrink: 0;
    }

    .section-header.theme-qualite .icon-badge {
        background: var(--teal-soft);
        color: var(--teal);
    }

    .section-header.theme-hse .icon-badge {
        background: var(--safety-soft);
        color: var(--safety);
    }

    .section-header i {
        font-size: 16px;
    }

    .section-header h2 {
        font-size: 19px;
        font-weight: 700;
        margin: 0;
        color: var(--ink);
    }

    .section-header .section-scope {
        margin-left: auto;
        font-size: 12px;
        color: var(--ink-soft);
        background: var(--bg-page);
        border: 1px solid var(--border);
        padding: 4px 12px;
        border-radius: 20px;
    }

    /* Hazard divider before HSE section */

    .hazard-divider {
        height: 5px;
        border-radius: 3px;
        margin: 6px 0 26px;
        background: repeating-linear-gradient(-45deg, var(--safety) 0 10px, var(--steel-dark) 10px 20px);
        opacity: .85;
    }

    /* KPI */

    .kpi-grid {
        display: grid;
        grid-template-columns:
            repeat(5, 1fr);
        gap: 15px;
        margin-bottom: 18px;
    }

    .kpi-grid.cols-4 {
        grid-template-columns: repeat(4, 1fr);
    }

    .kpi-grid.cols-2 {
        grid-template-columns: repeat(2, 1fr);
    }

    .kpi-card {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 18px;
        box-shadow: 0 3px 15px rgba(17,24,39,.05);
        border: 1px solid var(--border);
        min-height: 125px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        transition: transform .15s ease, box-shadow .15s ease, background-color .15s ease;
    }

    .kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(17,24,39,.08);
    }

    .kpi-card.accent-safety {
        border-top: 3px solid var(--safety);
        background: var(--safety-soft);
    }

    .kpi-card.accent-amber {
        border-top: 3px solid var(--amber);
        background: var(--amber-soft);
    }

    .kpi-card.accent-teal {
        border-top: 3px solid var(--teal);
        background: var(--teal-soft);
    }

    .kpi-title {
        color: var(--ink-soft);
        font-size: 13px;
        margin-bottom: 10px;
        font-weight: 500;
    }

    .kpi-value {
        font-size: 27px;
        font-weight: 700;
        color: var(--ink);
        font-variant-numeric: tabular-nums;
    }

    .kpi-card.accent-safety .kpi-value {
        color: var(--safety);
    }

    .kpi-card.accent-amber .kpi-value {
        color: var(--amber);
    }

    .kpi-card.accent-teal .kpi-value {
        color: var(--teal);
    }

    .kpi-subtitle {
        font-size: 12px;
        color: var(--ink-faint);
        margin-top: 5px;
    }

    /* GRAPHIQUES */

    .charts-grid {
        display: grid;
        grid-template-columns:
            repeat(2, 1fr);
        gap: 18px;
    }

    .chart-card {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 3px 15px rgba(17,24,39,.05);
        border: 1px solid var(--border);
    }

    .chart-card.full {
        grid-column: 1 / -1;
    }

    .chart-title {
        font-weight: 700;
        font-size: 14.5px;
        margin-bottom: 15px;
        color: var(--ink);
    }

    .chart-container {
        position: relative;
        height: 300px;
    }

    /* TABLE */

    .table-card {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 3px 15px rgba(17,24,39,.05);
        border: 1px solid var(--border);
        margin-top: 18px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .operational-table {
        width: 100%;
        border-collapse: collapse;
    }

    .operational-table th,
    .operational-table td {
        padding: 12px;
        border-bottom: 1px solid var(--row-border);
        text-align: left;
        font-size: 13px;
        color: var(--ink);
    }

    .operational-table th {
        font-weight: 700;
        color: var(--ink-soft);
        font-size: 11.5px;
        text-transform: uppercase;
        letter-spacing: .03em;
        background: var(--bg-page);
    }

    .operational-table tbody tr:hover {
        background: var(--bg-page);
    }

    .badge-status {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-execution {
        background: var(--badge-exec-bg);
        color: var(--badge-exec-color);
    }

    .badge-hold {
        background: var(--badge-hold-bg);
        color: var(--badge-hold-color);
    }

    .badge-cloture {
        background: var(--badge-cloture-bg);
        color: var(--badge-cloture-color);
    }

    .badge-reception {
        background: var(--badge-reception-bg);
        color: var(--badge-reception-color);
    }

    .badge-retard {
        background: var(--badge-retard-bg);
        color: var(--badge-retard-color);
    }

    @media(max-width: 1100px) {

        .kpi-grid,
        .kpi-grid.cols-4 {
            grid-template-columns:
                repeat(3, 1fr);
        }

        .filter-grid {
            grid-template-columns:
                repeat(2, 1fr);
        }
    }

    @media(max-width: 700px) {

        .kpi-grid,
        .kpi-grid.cols-4,
        .kpi-grid.cols-2,
        .charts-grid,
        .filter-grid {
            grid-template-columns: 1fr;
        }

        .chart-card.full {
            grid-column: auto;
        }

        .section-header .section-scope {
            display: none;
        }
    }

</style>


<div class="operational-dashboard">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="dashboard-header">

        <div class="header-text">

            <div class="header-mark"></div>

            <div>

                <h1>
                    Dashboard Opérationnel
                </h1>

                <p>
                    Suivi opérationnel des travaux,
                    ressources et conformité des projets
                </p>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- FILTRES --}}
    {{-- ========================================================= --}}

    <form method="GET"
          action="{{ route('dashboard.operationnel') }}">

        <div class="filter-card">

            <div class="filter-grid">

                {{-- Chef de projet --}}

                <div class="filter-group">

                    <label>
                        <i class="fa fa-user-tie"></i>
                        Chef de projet
                    </label>

                    <select name="chef_projet_id">

                        <option value="">
                            Tous les chefs de projet
                        </option>

                        @foreach($chefsProjet as $chef)

                            <option
                                value="{{ $chef->id }}"
                                {{ $chefProjetId == $chef->id ? 'selected' : '' }}
                            >
                                {{ $chef->nom }}
                                {{ $chef->prenom }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Projet / CMD --}}

                <div class="filter-group">

                    <label>
                        <i class="fa fa-file-contract"></i>
                        Projet / Commande
                    </label>

                    <select name="commande_id">

                        <option value="">
                            Toutes les commandes
                        </option>

                        @foreach($commandesListe as $commande)

                            <option
                                value="{{ $commande->id }}"
                                {{ $commandeId == $commande->id ? 'selected' : '' }}
                            >
                                {{ $commande->code }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Fournisseur --}}

                <div class="filter-group">

                    <label>
                        <i class="fa fa-industry"></i>
                        Fournisseur
                    </label>

                    <select name="fournisseur_id">

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


                {{-- Période --}}

                <div class="filter-group">

                    <label>
                        <i class="fa fa-calendar-alt"></i>
                        Période
                    </label>

                    <select name="periode">

                        <option
                            value="mois"
                            {{ $periode == 'mois' ? 'selected' : '' }}
                        >
                            Mois en cours
                        </option>

                        <option
                            value="trimestre"
                            {{ $periode == 'trimestre' ? 'selected' : '' }}
                        >
                            Trimestre en cours
                        </option>

                        <option
                            value="annee_passee"
                            {{ $periode == 'annee_passee' ? 'selected' : '' }}
                        >
                            Année passée
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

            <div style="margin-top:15px;">

                <button
                    type="submit"
                    class="btn-filter"
                >
                    <i class="fa fa-filter"></i>
                    Appliquer les filtres
                </button>

            </div>

        </div>

    </form>


    {{-- ========================================================= --}}
    {{-- 1. SUIVI DE L'AVANCEMENT DES TRAVAUX --}}
    {{-- ========================================================= --}}

    <div class="dashboard-section">

        <div class="section-header">

            <div class="icon-badge">
                <i class="fa fa-hard-hat"></i>
            </div>

            <h2>
                Suivi de l'avancement des travaux
            </h2>

            <span class="section-scope">
                par projet
            </span>

        </div>


        <div class="kpi-grid">

            <div class="kpi-card">

                <div class="kpi-title">
                    Projets en exécution
                </div>

                <div class="kpi-value">
                    {{ $totalProjetsActifs }}
                </div>

                <div class="kpi-subtitle">
                    CMD actuellement en exécution
                </div>

            </div>


            <div class="kpi-card accent-amber">

                <div class="kpi-title">
                    Projets suspendus
                </div>

                <div class="kpi-value">
                    {{ $totalProjetsSuspendus }}
                </div>

                <div class="kpi-subtitle">
                    Commandes en HOLD
                </div>

            </div>


            <div class="kpi-card accent-safety">

                <div class="kpi-title">
                    Projets en retard
                </div>

                <div class="kpi-value">
                    {{ $totalProjetsEnRetard }}
                </div>

                <div class="kpi-subtitle">
                    Date de fin prévisionnelle dépassée
                </div>

            </div>


            <div class="kpi-card">

                <div class="kpi-title">
                    Complexité moyenne
                </div>

                <div class="kpi-value">
                    {{ number_format($complexiteMoyenne, 1) }}
                </div>

                <div class="kpi-subtitle">
                    Indice moyen du portefeuille
                </div>

            </div>


            <div class="kpi-card accent-teal">

                <div class="kpi-title">
                    Avancement global
                </div>

                <div class="kpi-value">
                    {{ number_format($avancementGlobal, 1) }}%
                </div>

                <div class="kpi-subtitle">
                    Avancement physique
                </div>

            </div>

        </div>


        <div class="charts-grid">

            <div class="chart-card">

                <div class="chart-title">
                    Répartition des commandes par statut
                </div>

                <div class="chart-container">

                    <canvas id="statutsChart"></canvas>

                </div>

            </div>


            <div class="chart-card">

                <div class="chart-title">
                    Complexité du portefeuille
                </div>

                <div class="chart-container">

                    <canvas id="complexiteChart"></canvas>

                </div>

            </div>


            <div class="chart-card full">

                <div class="chart-title">
                    Avancement physique par projet
                </div>

                <div class="chart-container">

                    <canvas id="avancementChart"></canvas>

                </div>

            </div>

        </div>


        <div class="table-card">

            <div class="chart-title">
                Projets actuellement en retard
            </div>

            <div class="table-responsive">

                <table class="operational-table">

                    <thead>

                        <tr>

                            <th>
                                Commande
                            </th>

                            <th>
                                Fournisseur
                            </th>

                            <th>
                                Date OS
                            </th>

                            <th>
                                Durée
                            </th>

                            <th>
                                Date fin prévue
                            </th>

                            <th>
                                Statut
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($projetsEnRetard as $commande)

                            @php

                                $dateFinPrevue =
                                    $commande->date_os
                                    && is_numeric($commande->duree_travaux)
                                    ? \Carbon\Carbon::parse(
                                        $commande->date_os
                                    )->addDays(
                                        (int) $commande->duree_travaux
                                    )
                                    : null;

                            @endphp

                            <tr>

                                <td>
                                    {{ $commande->code }}
                                </td>

                                <td>
                                    {{ $commande->fournisseur->nom ?? '-' }}
                                </td>

                                <td>
                                    {{ $commande->date_os
                                        ? \Carbon\Carbon::parse($commande->date_os)->format('d/m/Y')
                                        : '-'
                                    }}
                                </td>

                                <td>
                                    {{ $commande->duree_travaux ?? '-' }}
                                    jours
                                </td>

                                <td>
                                    {{ $dateFinPrevue
                                        ? $dateFinPrevue->format('d/m/Y')
                                        : '-'
                                    }}
                                </td>

                                <td>

                                    <span class="badge-status badge-retard">
                                        En retard
                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    style="text-align:center;">

                                    Aucun projet en retard

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- 2. CONSOMMATION DES PRIX --}}
    {{-- ========================================================= --}}

    <div class="dashboard-section">

        <div class="section-header">

            <div class="icon-badge">
                <i class="fa fa-list-ol"></i>
            </div>

            <h2>
                Suivi de la consommation des prix des bordereaux
            </h2>

            <span class="section-scope">
                par projet / CMD
            </span>

        </div>


        <div class="kpi-grid cols-4">

            <div class="kpi-card">

                <div class="kpi-title">
                    Montant total bordereau
                </div>

                <div class="kpi-value">
                    {{ number_format($montantTotalBordereau, 0, ',', ' ') }}
                </div>

                <div class="kpi-subtitle">
                    MAD
                </div>

            </div>


            <div class="kpi-card">

                <div class="kpi-title">
                    Montant consommé
                </div>

                <div class="kpi-value">
                    {{ number_format($montantConsomme, 0, ',', ' ') }}
                </div>

                <div class="kpi-subtitle">
                    MAD
                </div>

            </div>


            <div class="kpi-card accent-teal">

                <div class="kpi-title">
                    Reste à consommer
                </div>

                <div class="kpi-value">
                    {{ number_format($resteAConsommer, 0, ',', ' ') }}
                </div>

                <div class="kpi-subtitle">
                    MAD
                </div>

            </div>


            <div class="kpi-card accent-amber">

                <div class="kpi-title">
                    Taux de consommation
                </div>

                <div class="kpi-value">
                    {{ number_format($tauxConsommation, 1) }}%
                </div>

                <div class="kpi-subtitle">
                    Consommation du bordereau
                </div>

            </div>

        </div>


        <div class="chart-card">

            <div class="chart-title">
                Consommation globale du bordereau
            </div>

            <div class="chart-container">

                <canvas id="consommationChart"></canvas>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- 3. PERSONNEL --}}
    {{-- ========================================================= --}}

    <div class="dashboard-section">

        <div class="section-header">

            <div class="icon-badge">
                <i class="fa fa-users"></i>
            </div>

            <h2>
                Suivi des accès du personnel
            </h2>

            <span class="section-scope">
                par projet
            </span>

        </div>


        <div class="kpi-grid cols-4">

            <div class="kpi-card">

                <div class="kpi-title">
                    Personnel total
                </div>

                <div class="kpi-value">
                    {{ $totalPersonnel }}
                </div>

                <div class="kpi-subtitle">
                    Personnel référencé
                </div>

            </div>


            <div class="kpi-card accent-teal">

                <div class="kpi-title">
                    Personnel actif
                </div>

                <div class="kpi-value">
                    {{ $personnelActif }}
                </div>

                <div class="kpi-subtitle">
                    Présent pendant la période
                </div>

            </div>


            <div class="kpi-card">

                <div class="kpi-title">
                    Heures cumulées
                </div>

                <div class="kpi-value">
                    {{ number_format($totalHeures, 0, ',', ' ') }}
                </div>

                <div class="kpi-subtitle">
                    Heures pointées
                </div>

            </div>


            <div class="kpi-card">

                <div class="kpi-title">
                    Moyenne heures / personne
                </div>

                <div class="kpi-value">
                    {{ number_format($moyenneHeuresPersonne, 1) }}
                </div>

                <div class="kpi-subtitle">
                    Heures moyennes
                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- 4. ENGINES --}}
    {{-- ========================================================= --}}

    <div class="dashboard-section">

        <div class="section-header">

            <div class="icon-badge">
                <i class="fa fa-truck"></i>
            </div>

            <h2>
                Suivi des accès des engins
            </h2>

            <span class="section-scope">
                par projet
            </span>

        </div>


        <div class="kpi-grid cols-2">

            <div class="kpi-card">

                <div class="kpi-title">
                    Total des engins
                </div>

                <div class="kpi-value">
                    {{ $totalEngins }}
                </div>

                <div class="kpi-subtitle">
                    Engins référencés
                </div>

            </div>


            <div class="kpi-card accent-teal">

                <div class="kpi-title">
                    Engins actifs
                </div>

                <div class="kpi-value">
                    {{ $enginsActifs }}
                </div>

                <div class="kpi-subtitle">
                    Actuellement actifs
                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- 5. QUALITÉ --}}
    {{-- ========================================================= --}}

    <div class="dashboard-section">

        <div class="section-header theme-qualite">

            <div class="icon-badge">
                <i class="fa fa-check-circle"></i>
            </div>

            <h2>
                Non-conformités Qualité
            </h2>

            <span class="section-scope">
                par projet
            </span>

        </div>


        <div class="kpi-grid">

            <div class="kpi-card accent-teal">

                <div class="kpi-title">
                    Total NC Qualité
                </div>

                <div class="kpi-value">
                    {{ $ncQualite->count() }}
                </div>

                <div class="kpi-subtitle">
                    NC liées aux projets filtrés
                </div>

            </div>


            @foreach($ncQualiteParClasse as $classe => $nombre)

                <div class="kpi-card">

                    <div class="kpi-title">
                        NC {{ $classe }}
                    </div>

                    <div class="kpi-value">
                        {{ $nombre }}
                    </div>

                    <div class="kpi-subtitle">
                        Classification
                    </div>

                </div>

            @endforeach

        </div>


        <div class="chart-card">

            <div class="chart-title">
                Répartition des NC Qualité par classe
            </div>

            <div class="chart-container">

                <canvas id="ncQualiteChart"></canvas>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- HAZARD DIVIDER --}}
    {{-- ========================================================= --}}

    <div class="hazard-divider"></div>


    {{-- ========================================================= --}}
    {{-- 6. HSE --}}
    {{-- ========================================================= --}}

    <div class="dashboard-section">

        <div class="section-header theme-hse">

            <div class="icon-badge">
                <i class="fa fa-shield-alt"></i>
            </div>

            <h2>
                Non-conformités HSE
            </h2>

            <span class="section-scope">
                par projet
            </span>

        </div>


        <div class="kpi-grid">

            <div class="kpi-card accent-safety">

                <div class="kpi-title">
                    Total NC HSE
                </div>

                <div class="kpi-value">
                    {{ $ncHse->count() }}
                </div>

                <div class="kpi-subtitle">
                    NC liées aux projets filtrés
                </div>

            </div>


            @foreach($ncHseParClasse as $classe => $nombre)

                <div class="kpi-card">

                    <div class="kpi-title">
                        NC {{ $classe }}
                    </div>

                    <div class="kpi-value">
                        {{ $nombre }}
                    </div>

                    <div class="kpi-subtitle">
                        Classification
                    </div>

                </div>

            @endforeach

        </div>


        <div class="chart-card">

            <div class="chart-title">
                Répartition des NC HSE par classe
            </div>

            <div class="chart-container">

                <canvas id="ncHseChart"></canvas>

            </div>

        </div>

    </div>

</div>


{{-- ============================================================= --}}
{{-- CHART.JS --}}
{{-- ============================================================= --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        /*
        |--------------------------------------------------------------------------
        | Détection du dark mode : <html data-theme="dark"> (défini par js/app.js)
        |--------------------------------------------------------------------------
        */

        function isDarkMode() {
            return document.documentElement.getAttribute('data-theme') === 'dark';
        }

        var dark = isDarkMode();

        /*
        |--------------------------------------------------------------------------
        | Palette commune (cosmétique uniquement — n'affecte aucune donnée)
        |--------------------------------------------------------------------------
        */

        var palette = dark
            ? ['#6f9bc7', '#5fc2ab', '#f0c04b', '#ff8a4d', '#9fb3d1', '#a7d6c9', '#4a5568']
            : ['#2C4A6B', '#2F8C7A', '#D19A1D', '#E2611C', '#6b7ba0', '#8fbfb2', '#c9c9d1'];

        var gridColor = dark ? '#263140' : '#eef1f4';
        var textColor = dark ? '#a9b4c2' : '#6b7280';

        Chart.defaults.font.family =
            "'Inter', -apple-system, BlinkMacSystemFont, sans-serif";

        Chart.defaults.color = textColor;


        /*
        |--------------------------------------------------------------------------
        | Statuts des commandes
        |--------------------------------------------------------------------------
        */

        new Chart(
            document.getElementById(
                'statutsChart'
            ),
            {
                type: 'doughnut',

                data: {

                    labels: @json(
                        array_keys($statutsProjets)
                    ),

                    datasets: [

                        {
                            data: @json(
                                array_values($statutsProjets)
                            ),

                            backgroundColor: palette,
                            borderWidth: 2,
                            borderColor: dark ? '#171f29' : '#fff'
                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    cutout: '65%',

                    plugins: {

                        legend: {

                            position: 'bottom',

                            labels: {

                                color: textColor

                            }

                        }

                    }

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Complexité
        |--------------------------------------------------------------------------
        */

        new Chart(
            document.getElementById(
                'complexiteChart'
            ),
            {
                type: 'doughnut',

                data: {

                    labels: @json(
                        array_keys($complexiteClasses)
                    ),

                    datasets: [

                        {
                            data: @json(
                                array_values($complexiteClasses)
                            ),

                            backgroundColor: palette,
                            borderWidth: 2,
                            borderColor: dark ? '#171f29' : '#fff'
                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    cutout: '65%',

                    plugins: {

                        legend: {

                            position: 'bottom',

                            labels: {

                                color: textColor

                            }

                        }

                    }

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Avancement
        |--------------------------------------------------------------------------
        */

        new Chart(
            document.getElementById(
                'avancementChart'
            ),
            {
                type: 'bar',

                data: {

                    labels: @json(
                        $avancementParProjet
                            ->pluck('code')
                            ->values()
                    ),

                    datasets: [

                        {
                            label:
                                'Avancement (%)',

                            data: @json(
                                $avancementParProjet
                                    ->pluck('avancement')
                                    ->values()
                            ),

                            backgroundColor: dark ? '#6f9bc7' : '#2C4A6B',
                            borderRadius: 6,
                            maxBarThickness: 42
                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    plugins: {

                        legend: {

                            display: false

                        }

                    },

                    scales: {

                        y: {

                            beginAtZero: true,

                            max: 100,

                            ticks: {

                                color: textColor

                            },

                            grid: {

                                color: gridColor

                            }

                        },

                        x: {

                            ticks: {

                                color: textColor

                            },

                            grid: {

                                display: false

                            }

                        }

                    }

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Consommation
        |--------------------------------------------------------------------------
        */

        new Chart(
            document.getElementById(
                'consommationChart'
            ),
            {
                type: 'doughnut',

                data: {

                    labels: [
                        'Consommé',
                        'Reste à consommer'
                    ],

                    datasets: [

                        {

                            data: [

                                {{ $montantConsomme }},

                                {{ $resteAConsommer }}

                            ],

                            backgroundColor: dark ? ['#6f9bc7', '#5fc2ab'] : ['#2C4A6B', '#2F8C7A'],
                            borderWidth: 2,
                            borderColor: dark ? '#171f29' : '#fff'

                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    cutout: '65%',

                    plugins: {

                        legend: {

                            position: 'bottom',

                            labels: {

                                color: textColor

                            }

                        }

                    }

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | NC Qualité
        |--------------------------------------------------------------------------
        */

        new Chart(
            document.getElementById(
                'ncQualiteChart'
            ),
            {
                type: 'doughnut',

                data: {

                    labels: @json(
                        array_keys($ncQualiteParClasse)
                    ),

                    datasets: [

                        {

                            data: @json(
                                array_values($ncQualiteParClasse)
                            ),

                            backgroundColor: palette,
                            borderWidth: 2,
                            borderColor: dark ? '#171f29' : '#fff'

                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    cutout: '65%',

                    plugins: {

                        legend: {

                            position: 'bottom',

                            labels: {

                                color: textColor

                            }

                        }

                    }

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | NC HSE
        |--------------------------------------------------------------------------
        */

        new Chart(
            document.getElementById(
                'ncHseChart'
            ),
            {
                type: 'doughnut',

                data: {

                    labels: @json(
                        array_keys($ncHseParClasse)
                    ),

                    datasets: [

                        {

                            data: @json(
                                array_values($ncHseParClasse)
                            ),

                            backgroundColor: dark
                                ? ['#ff8a4d', '#f0c04b', '#6f9bc7', '#9fb3d1']
                                : ['#E2611C', '#D19A1D', '#2C4A6B', '#6b7ba0'],
                            borderWidth: 2,
                            borderColor: dark ? '#171f29' : '#fff'

                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    cutout: '65%',

                    plugins: {

                        legend: {

                            position: 'bottom',

                            labels: {

                                color: textColor

                            }

                        }

                    }

                }

            }
        );

    }

);

</script>

@endsection