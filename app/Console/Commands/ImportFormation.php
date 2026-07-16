<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\FormationImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportFormation extends Command
{
    protected $signature='import:formation';

    protected $description='Importer les formations';

    public function handle()
    {
        Excel::import(
            new FormationImport(),
            storage_path('app/imports/formations.xlsx')
        );

        $this->info('Import des formations terminé.');

        return Command::SUCCESS;
    }
}