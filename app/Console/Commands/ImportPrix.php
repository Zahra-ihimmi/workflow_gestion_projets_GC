<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\PrixImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportPrix extends Command
{
    protected $signature = 'import:prix';

    protected $description = 'Importer les prix';

    public function handle()
    {
        Excel::import(
            new PrixImport(),
            storage_path('app/imports/prix.xlsx')
        );

        $this->info('Import des prix terminé avec succès !');

        return Command::SUCCESS;
    }
}