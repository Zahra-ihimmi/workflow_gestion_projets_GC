<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\LigneBudgetaireImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportLigneBudgetaire extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'import:ligne-budgetaire';

    /**
     * The console command description.
     */
    protected $description = 'Importer les lignes budgétaires depuis un fichier Excel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $chemin = storage_path('app/imports/lignebudgetaire.xlsx');

        Excel::import(new LigneBudgetaireImport, $chemin);

        $this->info('Import des lignes budgétaires terminé avec succès !');

        return Command::SUCCESS;
    }
}