<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LigneBudgetaire;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class AnalytiqueDashboardController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | FILTRES
        |--------------------------------------------------------------------------
        */

        $projetId = $request->input('projet_id');

        $client = $request->input('client');

        $fournisseurId = $request->input('fournisseur_id');

        $periode = $request->input(
            'periode',
            'annee_courante'
        );


        /*
        |--------------------------------------------------------------------------
        | LISTE DES PROJETS
        |--------------------------------------------------------------------------
        */

        $projets = LigneBudgetaire::query()
            ->orderBy('intitule')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | LISTE DES CLIENTS
        |--------------------------------------------------------------------------
        */

        $clients = LigneBudgetaire::query()
            ->whereNotNull('client')
            ->where('client', '!=', '')
            ->distinct()
            ->orderBy('client')
            ->pluck('client');


        /*
        |--------------------------------------------------------------------------
        | LISTE DES FOURNISSEURS
        |--------------------------------------------------------------------------
        */

        $fournisseurs = Fournisseur::query()
            ->orderBy('nom')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | REQUÊTE PRINCIPALE
        |--------------------------------------------------------------------------
        |
        | On récupère les LB avec :
        |
        | LB
        |  └── DA
        |       └── CMD
        |            └── Fournisseur
        |
        */

        $query = LigneBudgetaire::with([
            'demandesAchats.commande.fournisseur'
        ]);


        /*
        |--------------------------------------------------------------------------
        | FILTRE PROJET
        |--------------------------------------------------------------------------
        */

        if ($projetId) {

            $query->where(
                'id',
                $projetId
            );

        }


        /*
        |--------------------------------------------------------------------------
        | FILTRE CLIENT
        |--------------------------------------------------------------------------
        */

        if ($client) {

            $query->where(
                'client',
                $client
            );

        }


        /*
        |--------------------------------------------------------------------------
        | FILTRE PÉRIODE
        |--------------------------------------------------------------------------
        */

        switch ($periode) {

            case 'mois_courant':

                $query
                    ->whereYear(
                        'date_objective',
                        now()->year
                    )
                    ->whereMonth(
                        'date_objective',
                        now()->month
                    );

                break;


            case 'trimestre_courant':

                $query
                    ->whereBetween(
                        'date_objective',
                        [
                            now()->startOfQuarter(),
                            now()->endOfQuarter()
                        ]
                    );

                break;


            case 'annee_precedente':

                $query->whereYear(
                    'date_objective',
                    now()->year - 1
                );

                break;


            case 'annee_courante':

                $query->whereYear(
                    'date_objective',
                    now()->year
                );

                break;


            case 'annee_prochaine':

                $query->whereYear(
                    'date_objective',
                    now()->year + 1
                );

                break;


            case 'toutes':

                // Aucun filtre temporel

                break;

        }


        /*
        |--------------------------------------------------------------------------
        | RÉCUPÉRATION DES LIGNES BUDGÉTAIRES
        |--------------------------------------------------------------------------
        */

        $lignesBudgetaires = $query->get();


        /*
        |--------------------------------------------------------------------------
        | FILTRE FOURNISSEUR
        |--------------------------------------------------------------------------
        |
        | Le fournisseur est lié à la commande.
        |
        | LB
        |  └── DA
        |       └── CMD
        |            └── Fournisseur
        |
        */

        if ($fournisseurId) {

            $lignesBudgetaires = $lignesBudgetaires
                ->filter(function ($lb) use ($fournisseurId) {

                    return $lb->demandesAchats
                        ->contains(function ($da) use ($fournisseurId) {

                            return optional(
                                $da->commande
                            )->fournisseur_id == $fournisseurId;

                        });

                })
                ->values();

        }


        /*
        |--------------------------------------------------------------------------
        | KPI : NOMBRE TOTAL DE PROJETS
        |--------------------------------------------------------------------------
        */

        $totalProjets = $lignesBudgetaires->count();


        /*
        |--------------------------------------------------------------------------
        | KPI : NOMBRE PAR TYPE
        |--------------------------------------------------------------------------
        */

        $nombreCapex = $lignesBudgetaires
            ->where('type', 'CAPEX')
            ->count();

        $nombreOpex = $lignesBudgetaires
            ->where('type', 'OPEX')
            ->count();

        $nombrePdr = $lignesBudgetaires
            ->where('type', 'PDR')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | KPI : BUDGET TOTAL
        |--------------------------------------------------------------------------
        */

        $budgetTotal = $lignesBudgetaires
            ->sum('montant_estimatif');


        /*
        |--------------------------------------------------------------------------
        | KPI : BUDGET PAR TYPE
        |--------------------------------------------------------------------------
        */

        $montantCapex = $lignesBudgetaires
            ->where('type', 'CAPEX')
            ->sum('montant_estimatif');

        $montantOpex = $lignesBudgetaires
            ->where('type', 'OPEX')
            ->sum('montant_estimatif');

        $montantPdr = $lignesBudgetaires
            ->where('type', 'PDR')
            ->sum('montant_estimatif');


        /*
        |--------------------------------------------------------------------------
        | CALCUL DES DA
        |--------------------------------------------------------------------------
        */

        $demandesAchats = $lignesBudgetaires
            ->flatMap(function ($lb) {

                return $lb->demandesAchats;

            });


        $nombreDA = $demandesAchats->count();


        /*
        |--------------------------------------------------------------------------
        | CALCUL DES COMMANDES
        |--------------------------------------------------------------------------
        */

        $commandes = $demandesAchats
            ->map(function ($da) {

                return $da->commande;

            })
            ->filter();


        /*
        |--------------------------------------------------------------------------
        | NOMBRE DE COMMANDES
        |--------------------------------------------------------------------------
        */

        $nombreCommandes = $commandes->count();


        /*
        |--------------------------------------------------------------------------
        | MONTANT ENGAGÉ
        |--------------------------------------------------------------------------
        */

        $montantEngage = $commandes
            ->sum('montant_ht');


        /*
        |--------------------------------------------------------------------------
        | BUDGET RESTANT
        |--------------------------------------------------------------------------
        */

        $budgetRestant = $budgetTotal
            - $montantEngage;


        /*
        |--------------------------------------------------------------------------
        | TAUX D'ENGAGEMENT
        |--------------------------------------------------------------------------
        */

        $tauxEngagement = $budgetTotal > 0

            ? ($montantEngage / $budgetTotal) * 100

            : 0;


        /*
        |--------------------------------------------------------------------------
        | PROJETS LANCÉS
        |--------------------------------------------------------------------------
        |
        | Une LB est considérée comme lancée
        | si elle possède au moins une CMD.
        |
        */

        $projetsLances = $lignesBudgetaires
            ->filter(function ($lb) {

                return $lb->demandesAchats
                    ->contains(function ($da) {

                        return $da->commande !== null;

                    });

            })
            ->count();


        /*
        |--------------------------------------------------------------------------
        | PROJETS À LANCER
        |--------------------------------------------------------------------------
        */

        $projetsALancer = $totalProjets
            - $projetsLances;


        /*
        |--------------------------------------------------------------------------
        | PROJETS EN RETARD
        |--------------------------------------------------------------------------
        |
        | Date objectif dépassée
        | et projet non lancé.
        |
        */

        $projetsEnRetard = $lignesBudgetaires
            ->filter(function ($lb) {

                if (!$lb->date_objective) {

                    return false;

                }

                $dateObjectif = \Carbon\Carbon::parse(
                    $lb->date_objective
                );

                $estLance = $lb->demandesAchats
                    ->contains(function ($da) {

                        return $da->commande !== null;

                    });

                return $dateObjectif->isPast()
                    && !$estLance;

            })
            ->count();


        /*
        |--------------------------------------------------------------------------
        | LISTE DES PROJETS EN RETARD
        |--------------------------------------------------------------------------
        */

        $listeProjetsEnRetard = $lignesBudgetaires
            ->filter(function ($lb) {

                if (!$lb->date_objective) {

                    return false;

                }

                $dateObjectif = \Carbon\Carbon::parse(
                    $lb->date_objective
                );

                $estLance = $lb->demandesAchats
                    ->contains(function ($da) {

                        return $da->commande !== null;

                    });

                return $dateObjectif->isPast()
                    && !$estLance;

            })
            ->sortBy('date_objective');


        /*
        |--------------------------------------------------------------------------
        | LISTE DES PROJETS À LANCER
        |--------------------------------------------------------------------------
        */

        $listeProjetsALancer = $lignesBudgetaires
            ->filter(function ($lb) {

                $estLance = $lb->demandesAchats
                    ->contains(function ($da) {

                        return $da->commande !== null;

                    });

                return !$estLance;

            })
            ->sortBy('date_objective');


        /*
        |--------------------------------------------------------------------------
        | RETOUR À LA VUE
        |--------------------------------------------------------------------------
        */

        return view(
            'dashboards.analytique.index',
            compact(

                'projets',

                'clients',

                'fournisseurs',

                'lignesBudgetaires',

                'projetId',

                'client',

                'fournisseurId',

                'periode',

                'totalProjets',

                'nombreCapex',

                'nombreOpex',

                'nombrePdr',

                'budgetTotal',

                'montantCapex',

                'montantOpex',

                'montantPdr',

                'demandesAchats',

                'nombreDA',

                'commandes',

                'nombreCommandes',

                'montantEngage',

                'budgetRestant',

                'tauxEngagement',

                'projetsLances',

                'projetsALancer',

                'projetsEnRetard',

                'listeProjetsEnRetard',

                'listeProjetsALancer'

            )
        );
    }
}