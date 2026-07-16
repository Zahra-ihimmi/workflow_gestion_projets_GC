<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\PlanActionImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportPlanAction extends Command
{
    protected $signature = 'import:plan-action';

    protected $description = 'Importer les plans d action';

    public function handle()
    {
        Excel::import(
            new PlanActionImport(),
            storage_path('app/imports/plans_actions.xlsx')
        );

        $this->info('Import des plans d action terminé.');

        return Command::SUCCESS;
    }
}