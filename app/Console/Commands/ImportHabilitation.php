<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\HabilitationImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportHabilitation extends Command
{
    protected $signature='import:habilitation';

    protected $description='Importer les habilitations';

    public function handle()
    {
        Excel::import(
            new HabilitationImport(),
            storage_path('app/imports/habilitations.xlsx')
        );

        $this->info('Import des habilitations terminé.');

        return Command::SUCCESS;
    }
}