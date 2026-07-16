<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\RapportTravauxImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportRapportTravaux extends Command
{
    protected $signature = 'import:rapport-travaux';

    protected $description = 'Importer les rapports de travaux';

    public function handle()
    {
        Excel::import(
            new RapportTravauxImport(),
            storage_path('app/imports/rapport_travaux.xlsx')
        );

        $this->info('Import des rapports de travaux terminé avec succès !');

        return Command::SUCCESS;
    }
}