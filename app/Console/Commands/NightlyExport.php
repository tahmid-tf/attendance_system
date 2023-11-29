<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NightlyExport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'nightly:export';
    protected $description = 'Run the export_data function nightly';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Call your export_data function or its logic here
        // For example, if your export_data method is in a controller:
        app()->call('App\Http\Controllers\AttendanceExportController@export');

        $this->info('Nightly export_data function completed successfully.');
    }
}
