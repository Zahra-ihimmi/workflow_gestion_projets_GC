<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\PersonnelImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportPersonnel extends Command
{
    protected $signature='import:personnel';

    protected $description='Importer les personnels';

    public function handle()
    {
        Excel::import(
            new PersonnelImport(),
            storage_path('app/imports/personnels.xlsx')
        );

        $this->info('Import des personnels terminé.');

        return Command::SUCCESS;
    }
}