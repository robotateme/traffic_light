<?php

namespace App\Services\TrafficLightStateMachine\Contracts;

use App\Services\TrafficLightStateMachine\Enums\StateMachineContextEnum;

abstract class BaseState implements StateInterface
{
    public function __construct(
        public string $alias,
        public int $duration,
        public string $transition,
    ) {
    }

    /**
     * @throws \App\Services\TrafficLightStateMachine\Exceptions\EnumCaseValuesException
     */
    public function handle(): string
    {
        return StateMachineContextEnum::getCase($this->alias)->message();
    }

    /**
     * @throws \App\Services\TrafficLightStateMachine\Exceptions\EnumCaseValuesException
     */
    public function nextState(): StateInterface
    {
        return StateMachineContextEnum::getCase($this->transition)->stateInstance();
    }
}