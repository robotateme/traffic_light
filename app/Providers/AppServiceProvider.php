<?php

namespace App\Providers;

use App\Repositories\Contracts\CacheRepositoryInterface;
use App\Repositories\Contracts\TrafficLogRepositoryInterface;
use App\Repositories\TrafficLightCacheRepository;
use App\Repositories\TrafficLogRepository;
use App\Services\Contracts\TrafficLightServiceInterface;
use App\Services\TrafficLightService;
use App\Services\TrafficLightStateMachine\Contracts\StateMachineInterface;
use App\Services\TrafficLightStateMachine\StateMachine;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TrafficLightServiceInterface::class, TrafficLightService::class);
        $this->app->bind(CacheRepositoryInterface::class, TrafficLightCacheRepository::class);
        $this->app->bind(TrafficLogRepositoryInterface::class, TrafficLogRepository::class);
        $this->app->bind(StateMachineInterface::class, StateMachine::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::useScriptTagAttributes([
            'defer' => true, // Specify an attribute without a value...
        ]);
    }
}
