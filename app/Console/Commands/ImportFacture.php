<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\FactureImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportFacture extends Command
{
    protected $signature = 'import:facture';

    protected $description = 'Importer les factures';

    public function handle()
    {
        Excel::import(
            new FactureImport(),
            storage_path('app/imports/factures.xlsx')
        );

        $this->info('Import des factures terminé avec succès !');

        return Command::SUCCESS;
    }
}