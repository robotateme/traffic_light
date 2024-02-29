<?php

namespace App\Console\Commands;

use App\Services\Contracts\TrafficLightServiceInterface;
use Illuminate\Console\Command;

class TrafficLightCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:traffic-light';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Switching traffic lights according to sequence';

    /**
     * @param  \App\Services\TrafficLightService  $trafficLightService
     */
    public function __construct(protected TrafficLightServiceInterface $trafficLightService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @throws \Exception
     */
    public function handle()
    {
        while (true) {
            sleep(1);
            $this->trafficLightService->trafficLightClock();
        }
    }
}
