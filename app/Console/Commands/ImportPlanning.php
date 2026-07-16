<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\PlanningImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportPlanning extends Command
{
    protected $signature = 'import:planning';

    protected $description = 'Importer les plannings';

    public function handle()
    {
        Excel::import(
            new PlanningImport(),
            storage_path('app/imports/plannings.xlsx')
        );

        $this->info('Import des plannings terminé avec succès !');

        return Command::SUCCESS;
    }
}