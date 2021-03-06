<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OffersImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offers:import {--filter=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import offers from XML.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (config('import') as $importer => $value) {
            $this->output->title("CPA $importer importing...");
            $importer::Import($value, $this, $this->output, $this->option('filter'));
        }
        $this->output->success('Import successful');
        return 0;
    }
}
