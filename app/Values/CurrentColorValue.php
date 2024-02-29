<?php

namespace App\Values;

use App\Services\TrafficLightStateMachine\Enums\StateMachineContextEnum;

class CurrentColorValue
{
    private string $currentColor;

    /**
     * @param  string  $currentState
     * @throws \App\Services\TrafficLightStateMachine\Exceptions\EnumCaseValuesException
     */
    public function __construct(private readonly string $currentState)
    {
        $this->currentColor = StateMachineContextEnum::getCase($this->currentState)->color();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->currentColor;
    }
}