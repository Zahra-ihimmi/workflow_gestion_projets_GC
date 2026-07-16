<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\DemandeAchatImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportDemandeAchat extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'import:demande-achat';

    /**
     * The console command description.
     */
    protected $description = 'Importer les demandes d\'achat depuis un fichier Excel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $chemin = storage_path('app/imports/demandeachats.xlsx');

        Excel::import(new DemandeAchatImport(), $chemin);

        $this->info('Import des demandes d\'achat terminé avec succès !');

        return Command::SUCCESS;
    }
}