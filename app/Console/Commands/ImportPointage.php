<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\PointageImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportPointage extends Command
{
    protected $signature = 'import:pointage';

    protected $description = 'Importer les pointages';

    public function handle()
    {
        Excel::import(
            new PointageImport(),
            storage_path('app/imports/pointages.xlsx')
        );

        $this->info('Import des pointages terminé.');

        return Command::SUCCESS;
    }
}