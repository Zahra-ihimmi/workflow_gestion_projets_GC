<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\RapportActiviteImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportRapportActivite extends Command
{
    protected $signature = 'import:rapport-activite';

    protected $description = 'Importer les rapports d activité';

    public function handle()
    {
        Excel::import(
            new RapportActiviteImport(),
            storage_path('app/imports/rapport_activite.xlsx')
        );

        $this->info('Import des rapports d activité terminé avec succès !');

        return Command::SUCCESS;
    }
}