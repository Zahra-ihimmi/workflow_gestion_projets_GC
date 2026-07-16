<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\NonConformiteImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportNonConformite extends Command
{
    protected $signature = 'import:non-conformite';

    protected $description = 'Importer les non conformités';

    public function handle()
    {
        Excel::import(
            new NonConformiteImport(),
            storage_path('app/imports/non_conformites.xlsx')
        );

        $this->info('Import des non conformités terminé.');

        return Command::SUCCESS;
    }
}