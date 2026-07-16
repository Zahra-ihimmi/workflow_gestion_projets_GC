<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\CommandeImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportCommande extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'import:commande';

    /**
     * The console command description.
     */
    protected $description = 'Importer les commandes depuis un fichier Excel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $chemin = storage_path('app/imports/commandes.xlsx');

        Excel::import(new CommandeImport(), $chemin);

        $this->info('Import des commandes terminé avec succès !');

        return Command::SUCCESS;
    }
}