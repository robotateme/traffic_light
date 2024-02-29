<?php

namespace App\Services\TrafficLightStateMachine\Enums\Traits;

use App\Services\TrafficLightStateMachine\Enums\StateMachineContextEnum;
use App\Services\TrafficLightStateMachine\Exceptions\EnumCaseValuesException;

trait GetCaseTrait
{
    /**
     * @param  string  $alias
     * @return \App\Services\TrafficLightStateMachine\Enums\StateMachineContextEnum|null
     * @throws \App\Services\TrafficLightStateMachine\Exceptions\EnumCaseValuesException
     */
    public static function getCase(string $alias): ?StateMachineContextEnum
    {
        return self::tryFrom($alias) ?? throw new EnumCaseValuesException;
    }

    /**
     * @return array
     */
    public static function values(): array
    {
        $values = [];

        foreach (self::cases() as $case) {
            $values[] = $case->value;
        }

        return $values;
    }
}