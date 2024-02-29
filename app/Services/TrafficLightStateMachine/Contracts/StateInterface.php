<?php

namespace App\Services\TrafficLightStateMachine\Contracts;

use App\Services\TrafficLightStateMachine\Enums\StateMachineContextEnum;

interface StateInterface
{
    public function __construct(string $alias, int $duration, string $transitionTo);

    public function handle();
}