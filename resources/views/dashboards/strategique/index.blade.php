@extends('layouts.app')

@section('title','Dashboard Stratégique')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Dashboard Stratégique</h1>
        <p class="page-subtitle">
            Suivi stratégique des études
        </p>
    </div>
</div>

<!-- =========================
        FILTRES
========================= -->

<div class="card">

    <div class="card-header">
        <div class="card-title">
            <i class="fa fa-filter"></i>
            Filtres
        </div>
    </div>

    <div class="card-body">

        <form method="GET">

            <div class="filters-grid">

                <div class="form-group">

                    <label>Année</label>

                    <select name="annee" class="form-control">

                        <option value="">Toutes les années</option>

                        @foreach($anneesDisponibles as $a)

                            <option value="{{ $a }}"
                                {{ $annee == $a ? 'selected' : '' }}>

                                {{ $a }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="form-group">

                    <label>Client</label>

                    <select
                        name="client"
                        class="form-control"
                    >

                        <option value="">
                            Tous
                        </option>

                        @foreach($clients as $c)

                            <option
                                value="{{ $c }}"
                                {{ $client==$c?'selected':'' }}
                            >

                                {{ $c }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="form-group">

                    <label>Type</label>

                    <select
                        name="type"
                        class="form-control"
                    >

                        <option value="">
                            Tous
                        </option>

                        <option
                            value="CAPEX"
                            {{ $type=='CAPEX'?'selected':'' }}
                        >

                            CAPEX

                        </option>

                        <option
                            value="OPEX"
                            {{ $type=='OPEX'?'selected':'' }}
                        >

                            OPEX

                        </option>

                        <option
                            value="PDR"
                            {{ $type=='PDR'?'selected':'' }}
                        >

                            PDR

                        </option>

                    </select>

                </div>

                <div class="form-group" style="max-width:170px;">

                    <label>&nbsp;</label>

                    <button type="submit" class="btn btn-primary">

                        <i class="fa-solid fa-filter"></i>

                        Filtrer

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<br>

<!-- =========================
        KPI
========================= -->

<div class="stats-grid">

    <div class="stat-card">

        <div class="stat-header">

            <div>

                <div class="stat-label">

                    Budget CAPEX

                </div>

                <div class="stat-value">

                    {{ number_format($montantCapex,0,',',' ') }}

                </div>

            </div>

            <div class="stat-icon blue">

                <i class="fa fa-coins"></i>

            </div>

        </div>

    </div>

    <div class="stat-card">

        <div class="stat-header">

            <div>

                <div class="stat-label">

                    Budget OPEX

                </div>

                <div class="stat-value">

                    {{ number_format($montantOpex,0,',',' ') }}

                </div>

            </div>

            <div class="stat-icon green">

                <i class="fa fa-wallet"></i>

            </div>

        </div>

    </div>

    <div class="stat-card">

        <div class="stat-header">

            <div>

                <div class="stat-label">

                    Budget PDR

                </div>

                <div class="stat-value">

                    {{ number_format($montantPdr,0,',',' ') }}

                </div>

            </div>

            <div class="stat-icon purple">

                <i class="fa fa-layer-group"></i>

            </div>

        </div>

    </div>

    <div class="stat-card">

        <div class="stat-header">

            <div>

                <div class="stat-label">

                    Etudes en retard

                </div>

                <div class="stat-value">

                    {{ $etudesRetard }}

                </div>

            </div>

            <div class="stat-icon red">

                <i class="fa fa-triangle-exclamation"></i>

            </div>

        </div>

    </div>

    <div class="stat-card">

        <div class="stat-header">

            <div>

                <div class="stat-label">

                    Projets programmés

                </div>

                <div class="stat-value">

                    {{ $projetsProgrammes }}

                </div>

            </div>

            <div class="stat-icon blue">

                <i class="fa fa-folder"></i>

            </div>

        </div>

    </div>
</div>





<div class="stats-grid">

    <div class="stat-card">

        <div class="stat-header">

            <div>

                <div class="stat-label">

                    Consommation LB

                </div>

                <div class="stat-value">

                    {{ number_format($consommationLB,0,',',' ') }}

                </div>

            </div>

            <div class="stat-icon blue">

                <i class="fa-solid fa-chart-line"></i>

            </div>

        </div>

    </div>

    <div class="stat-card">

        <div class="stat-header">

            <div>

                <div class="stat-label">

                    Reste Budget

                </div>

                <div class="stat-value">

                    {{ number_format($resteLB,0,',',' ') }}

                </div>

            </div>

            <div class="stat-icon green">

                <i class="fa-solid fa-wallet"></i>

            </div>

        </div>

    </div>

    <div class="stat-card">

        <div class="stat-header">

            <div>

                <div class="stat-label">

                    Projets lancés

                </div>

                <div class="stat-value">

                    {{ $projetsLances }}

                </div>

            </div>

            <div class="stat-icon purple">

                <i class="fa-solid fa-rocket"></i>

            </div>

        </div>

    </div>

    <div class="stat-card">

        <div class="stat-header">

            <div>

                <div class="stat-label">

                    Reste à lancer

                </div>

                <div class="stat-value">

                    {{ $resteALancer }}

                </div>

            </div>

            <div class="stat-icon red">

                <i class="fa-solid fa-hourglass-half"></i>

            </div>

        </div>

    </div>

</div>

<div class="project-distribution-card">

    <div class="project-header">

        <div>
            <div class="stat-label">
                Total Projets
            </div>

            <div class="stat-value">
                {{ $nbProjet }}
            </div>

        </div>

        <div class="stat-icon blue">
            <i class="fa fa-folder-open"></i>
        </div>

    </div>


    <!-- BARRE DE REPARTITION -->

    @php
        $total = $nbProjet > 0 ? $nbProjet : 1;

        $capexPercent = ($nbCapex / $total) * 100;
        $opexPercent  = ($nbOpex / $total) * 100;
        $pdrPercent   = ($nbPdr / $total) * 100;
    @endphp


    <div class="project-bar">

        <div class="bar-capex"
             style="width:{{ $capexPercent }}%">
        </div>

        <div class="bar-opex"
             style="width:{{ $opexPercent }}%">
        </div>

        <div class="bar-pdr"
             style="width:{{ $pdrPercent }}%">
        </div>

    </div>


    <div class="project-legends">


        <div>
            <span class="legend capex-color"></span>
            CAPEX :
            <b>{{ $nbCapex }}</b>
            ({{ round($capexPercent,1) }}%)
        </div>


        <div>
            <span class="legend opex-color"></span>
            OPEX :
            <b>{{ $nbOpex }}</b>
            ({{ round($opexPercent,1) }}%)
        </div>


        <div>
            <span class="legend pdr-color"></span>
            PDR :
            <b>{{ $nbPdr }}</b>
            ({{ round($pdrPercent,1) }}%)
        </div>


    </div>


</div>


<br>

<!-- =========================
        GRAPHIQUES
========================= -->

<div class="grid-2">

    <div class="card budget-card">

        <div class="card-header">
            <div class="card-title">
                <i class="fa fa-chart-pie"></i>
                Répartition Budgétaire
            </div>
        </div>

        <div class="card-body">

            <canvas id="budgetChart"></canvas>

            <div id="budgetLegend" class="budget-legend"></div>

        </div>

    </div>

    <div class="card">

        <div class="card-header">

            <div class="card-title">

                <i class="fa fa-chart-bar"></i>

                Evolution annuelle

            </div>

        </div>

        <div class="card-body">

            <canvas id="anneeChart"></canvas>

        </div>

    </div>

</div>

<br>

<!-- =========================
        ETUDES EN RETARD
========================= -->

<div class="card">

    <div class="card-header">

        <div class="card-title">

            <i class="fa fa-clock"></i>

            Liste des études en retard

        </div>

    </div>

    <div class="card-body">

        <table class="table">

            <thead>

                <tr>

                    <th>Code</th>

                    <th>Intitulé</th>

                    <th>Client</th>

                    <th>Type</th>

                    <th>Date objective</th>

                </tr>

            </thead>

            <tbody>

                @foreach($listeRetard as $lb)

                <tr>

                    <td>{{ $lb->code }}</td>

                    <td>{{ $lb->intitule }}</td>

                    <td>{{ $lb->client }}</td>

                    <td>{{ $lb->type }}</td>

                    <td>{{ $lb->date_objective }}</td>

                </tr>

                @endforeach
                            </tbody>

        </table>

    </div>

</div>

<br>

<!-- =========================
        ETUDES A LANCER
========================= -->

<div class="card">

    <div class="card-header">

        <div class="card-title">

            <i class="fa-solid fa-rocket"></i>

            Liste des études à lancer (50 prochains jours)

        </div>

    </div>

    <div class="card-body">

        <table class="table">

            <thead>

                <tr>

                    <th>Code</th>
                    <th>Intitulé</th>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Date objectif</th>

                </tr>

            </thead>

            <tbody>

                @forelse($listeALancer as $lb)

                <tr>

                    <td>{{ $lb->code }}</td>

                    <td>{{ $lb->intitule }}</td>

                    <td>{{ $lb->client }}</td>

                    <td>{{ $lb->type }}</td>

                    <td>{{ \Carbon\Carbon::parse($lb->date_objective)->format('d/m/Y') }}</td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" style="text-align:center">

                        Aucune étude à lancer.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<br>

<!-- =========================
        TIMELINE
========================= -->

<div class="card">

    <div class="card-header">

        <div class="card-title">

            <i class="fa-solid fa-calendar-days"></i>

            Timeline des prochaines études

        </div>

    </div>

    <div class="card-body">

        <table class="table">

            <thead>

                <tr>

                    <th>Date</th>
                    <th>Projet</th>
                    <th>Client</th>

                </tr>

            </thead>

            <tbody>

            @foreach($timeline as $lb)

                <tr>

                    <td>

                        {{ \Carbon\Carbon::parse($lb->date_objective)->format('d/m/Y') }}

                    </td>

                    <td>

                        {{ $lb->intitule }}

                    </td>

                    <td>

                        {{ $lb->client }}

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const budgetChart = new Chart(document.getElementById('budgetChart'),{

    type:'doughnut',

    data:{

        labels:@json($budgetLabels),

        datasets:[{

            data:@json($budgetValues),

            backgroundColor:[
                '#4e73df',
                '#1cc88a',
                '#f6c23e',
                '#e74a3b',
                '#36b9cc'
            ]

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        plugins:{

            legend:{
                position:'bottom'
            }

        }

    }

});


const anneeChart = new Chart(document.getElementById('anneeChart'),{

    type:'bar',

    data:{

        labels:@json($annees),

        datasets:[{

            label:'Nombre de projets',

            data:@json($nbProjets),

            backgroundColor:'#4e73df',

            borderRadius:8

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        scales:{

            y:{

                beginAtZero:true

            }

        }

    }

});



</script>

@endpush