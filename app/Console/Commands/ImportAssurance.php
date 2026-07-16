<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\AssuranceImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportAssurance extends Command
{
    protected $signature = 'import:assurance';

    protected $description = 'Importer les assurances';

    public function handle()
    {
        Excel::import(
            new AssuranceImport(),
            storage_path('app/imports/assurances.xlsx')
        );

        $this->info('Import des assurances terminé.');

        return Command::SUCCESS;
    }
}