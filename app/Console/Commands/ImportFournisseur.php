<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\FournisseurImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportFournisseur extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'import:fournisseur';

    /**
     * The console command description.
     */
    protected $description = 'Importer les fournisseurs depuis un fichier Excel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $chemin = storage_path('app/imports/fournisseurs.xlsx');

        Excel::import(new FournisseurImport, $chemin);

        $this->info('Import des fournisseurs terminé avec succès !');

        return Command::SUCCESS;
    }
}
