<?php

namespace App\Services\TrafficLightStateMachine\States;

use App\Services\TrafficLightStateMachine\Contracts\BaseState;
use App\Services\TrafficLightStateMachine\Enums\StateMachineContextEnum;

class RedState extends BaseState
{

    private const TRANSITION_TO = StateMachineContextEnum::DriverYellow;

    public int $duration = 2;
}