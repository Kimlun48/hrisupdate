<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ParamPeriode; 
class ParPeriod extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parperiod:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $data = [
            'startdate' => 23,
            'enddate' => 29,
            'status' => 'NonAktif',
        ];

        ParamPeriode::create($data);

        $this->info('Data inserted successfully.');
    
    }
}
