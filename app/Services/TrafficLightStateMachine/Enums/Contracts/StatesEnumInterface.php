<?php

namespace App\Services\TrafficLightStateMachine\Enums\Contracts;

use App\Services\TrafficLightStateMachine\Enums\StateMachineContextEnum;

interface StatesEnumInterface
{
    /**
     * @throws \App\Services\TrafficLightStateMachine\Exceptions\EnumCaseValuesException
     */
    public static function getCase(string $alias): ?StateMachineContextEnum;

}