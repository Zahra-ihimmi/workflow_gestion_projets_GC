<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\VehiculeImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportVehicule extends Command
{
    protected $signature = 'import:vehicule';

    protected $description = 'Importer les véhicules';

    public function handle()
    {
        Excel::import(
            new VehiculeImport(),
            storage_path('app/imports/vehicules.xlsx')
        );

        $this->info('Import des véhicules terminé.');

        return Command::SUCCESS;
    }
}