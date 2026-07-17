<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\LigneBudgetaire;
use Carbon\Carbon;

class StrategicDashboardController extends Controller
{
    public function index()
    {

        /*
        |--------------------------------------------------------------------------
        | FILTRES
        |--------------------------------------------------------------------------
        */

        $annee = request('annee');
        $type = request('type');
        $client = request('client');

        /*
        |--------------------------------------------------------------------------
        | REQUETE PRINCIPALE
        |--------------------------------------------------------------------------
        */

        $query = LigneBudgetaire::query();

        if (!empty($annee)) {
            $query->where('annee', $annee);
        }

        if (!empty($type)) {
            $query->where('type', $type);
        }

        if (!empty($client)) {
            $query->where('client', $client);
        }

        /*
        |--------------------------------------------------------------------------
        | KPI ETUDES
        |--------------------------------------------------------------------------
        */

        $montantCapex = (clone $query)
            ->where('type', 'CAPEX')
            ->sum('montant_estimatif');

        $montantOpex = (clone $query)
            ->where('type', 'OPEX')
            ->sum('montant_estimatif');

        $montantPdr = (clone $query)
            ->where('type', 'PDR')
            ->sum('montant_estimatif');

        $nbProjet = LigneBudgetaire::count();

        $nbCapex = (clone $query)
            ->where('type', 'CAPEX')
            ->count();

        $nbOpex = (clone $query)
            ->where('type', 'OPEX')
            ->count();

        $nbPdr = (clone $query)
            ->where('type', 'PDR')
            ->count();

        $projetsProgrammes = (clone $query)->count();

        $projetsAnneePrecedente = LigneBudgetaire::where(
            'annee',
            now()->year - 1
        )->count();

        $etudesRetard = (clone $query)
            ->whereDate('date_objective', '<', today())
            ->count();

        $etudesALancer = (clone $query)
            ->whereBetween('date_objective', [
                today(),
                today()->copy()->addDays(50)
            ])
            ->count();

        /*
        |--------------------------------------------------------------------------
        | KPI COMMANDES
        |--------------------------------------------------------------------------
        */

        $montantCommande = Commande::sum('montant_ht');

        $nombreCommandes = Commande::count();

        $commandesActives = Commande::where('statut', 'EN COURS')->count();

        $commandesHold = Commande::where('statut', 'HOLD')->count();

        $nombreFournisseurs = Commande::distinct('fournisseur_id')->count();

        /*
        |--------------------------------------------------------------------------
        | CONSOMMATION DES LB
        |--------------------------------------------------------------------------
        */

        $lignesBudgetaires = (clone $query)
            ->with('demandesAchats.commande')
            ->get();

        $consommationLB = $lignesBudgetaires->sum(function ($lb) {

            return $lb->demandesAchats->sum(function ($da) {

                return optional($da->commande)->montant_ht ?? 0;

            });

        });

        $totalLB = $lignesBudgetaires->sum('montant_estimatif');

        $resteLB = $totalLB - $consommationLB;

        $pourcentageConsommation = 0;

        if ($totalLB > 0) {

            $pourcentageConsommation = round(

                ($consommationLB / $totalLB) * 100,

                2

            );

        }

        $optimisation = 100 - $pourcentageConsommation;
        $respectEnveloppe = $consommationLB <= $totalLB ? 100 : 0;
        $budgetEngage = $consommationLB;
        $lbActives = (clone $query)

            ->whereHas('demandesAchats.commande')

            ->get();


        $lbConsommees = $lignesBudgetaires->filter(function($lb){

            $commande = $lb->demandesAchats

                ->sum(function($da){

                    return optional($da->commande)->montant_ht ?? 0;

                });

            return $commande >= $lb->montant_estimatif;

        });

        $projetsLances = $lignesBudgetaires->filter(function ($lb) {

            return $lb->demandesAchats->contains(function ($da) {

                return $da->commande != null;

            });

        })->count();

        $resteALancer = $projetsProgrammes - $projetsLances;

        /*
        |--------------------------------------------------------------------------
        | GRAPHIQUE 1
        | Répartition CAPEX / OPEX / PDR
        |--------------------------------------------------------------------------
        */

        $budgetData = (clone $query)
            ->selectRaw('type, SUM(montant_estimatif) as total')
            ->groupBy('type')
            ->get();

        $budgetLabels = $budgetData->pluck('type');

        $budgetValues = $budgetData->pluck('total');

        /*
        |--------------------------------------------------------------------------
        | GRAPHIQUE 2
        | Evolution annuelle
        |--------------------------------------------------------------------------
        */

        $evolution = (clone $query)
            ->selectRaw('annee, COUNT(*) as total')
            ->groupBy('annee')
            ->orderBy('annee')
            ->get();

        $annees = $evolution->pluck('annee');

        $nbProjets = $evolution->pluck('total');

                /*
        |--------------------------------------------------------------------------
        | TIMELINE
        |--------------------------------------------------------------------------
        */

        $timeline = (clone $query)
            ->orderBy('date_objective')
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | LISTE DES ETUDES EN RETARD
        |--------------------------------------------------------------------------
        */

        $listeRetard = (clone $query)
            ->whereDate('date_objective', '<', today())
            ->orderBy('date_objective')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | LISTE DES ETUDES A LANCER
        |--------------------------------------------------------------------------
        */

        $listeALancer = (clone $query)
            ->whereBetween('date_objective', [
                today(),
                today()->copy()->addDays(50)
            ])
            ->orderBy('date_objective')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | DONNEES DES FILTRES
        |--------------------------------------------------------------------------
        */

        $clients = LigneBudgetaire::select('client')
            ->distinct()
            ->orderBy('client')
            ->pluck('client');

        $anneesDisponibles = LigneBudgetaire::select('annee')
            ->distinct()
            ->orderBy('annee')
            ->pluck('annee');

        /*
        |--------------------------------------------------------------------------
        | RETOUR DE LA VUE
        |--------------------------------------------------------------------------
        */

        return view(
            'dashboards.strategique.index',
            compact(

                'montantCapex',
                'montantOpex',
                'montantPdr',

                'nbProjet',
                'nbCapex',
                'nbOpex',
                'nbPdr',

                'projetsProgrammes',
                'projetsAnneePrecedente',

                'etudesRetard',
                'etudesALancer',

                'consommationLB',
                'resteLB',
                'pourcentageConsommation',
                'optimisation',

                'projetsLances',
                'resteALancer',

                'montantCommande',
                'nombreCommandes',
                'commandesActives',
                'commandesHold',
                'nombreFournisseurs',

                'budgetLabels',
                'budgetValues',

                'annees',
                'nbProjets',

                'timeline',

                'listeRetard',
                'listeALancer',

                'clients',
                'anneesDisponibles',

                'annee',
                'client',
                'type',
                'respectEnveloppe',
                'budgetEngage',
                'lbActives',
                'lbConsommees'
            )
        );

    }
}