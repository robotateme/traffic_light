<?php

namespace App\Services\TrafficLightStateMachine\Enums\Contracts;

use App\Services\TrafficLightStateMachine\Contracts\StateInterface;

interface StateMachineContextEnumInterface
{
    /**
     * @return \App\Services\TrafficLightStateMachine\Contracts\StateInterface
     * @throws \App\Services\TrafficLightStateMachine\Exceptions\EnumCaseValuesException
     */
    public function stateInstance(): StateInterface;

    /**
     * @return string
     */
    public function color(): string;

    /**
     * @return string
     */
    public function message(): string;
}