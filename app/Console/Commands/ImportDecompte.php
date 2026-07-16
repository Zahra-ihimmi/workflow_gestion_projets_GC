<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\DecompteImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportDecompte extends Command
{
    protected $signature = 'import:decompte';

    protected $description = 'Importer les décomptes';

    public function handle()
    {
        Excel::import(
            new DecompteImport(),
            storage_path('app/imports/decomptes.xlsx')
        );

        $this->info('Import des décomptes terminé avec succès !');

        return Command::SUCCESS;
    }
}