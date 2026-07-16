<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\UtilisateurImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportUtilisateur extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'import:utilisateur';
    /**
     * The console command description.
     */
    protected $description = 'Importer les utilisateurs depuis un fichier Excel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $chemin = storage_path('app/imports/utilisateurs.xlsx');

        Excel::import(new UtilisateurImport, $chemin);

        $this->info('Import des utilisateurs terminé avec succès !');

        return Command::SUCCESS;
    }
}
