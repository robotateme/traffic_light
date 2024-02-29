<?php

namespace App\Services\TrafficLightStateMachine;

use App\Services\TrafficLightStateMachine\Contracts\BaseState;
use App\Services\TrafficLightStateMachine\Contracts\StateInterface;
use App\Services\TrafficLightStateMachine\Contracts\StateMachineInterface;
use App\Services\TrafficLightStateMachine\Enums\StateMachineContextEnum;
use Spatie\LaravelData\Data;

class StateMachine implements StateMachineInterface
{
    /**
     * @param  \App\DTOs\CurrentStateDto  $currentStateDto
     * @return \App\Services\TrafficLightStateMachine\Contracts\StateInterface|null
     * @throws \App\Services\TrafficLightStateMachine\Exceptions\EnumCaseValuesException
     */
    public function doTransition(Data $currentStateDto): ?StateInterface
    {
        $stateInstance = StateMachineContextEnum::getCase($currentStateDto->currentState)
            ->stateInstance();

        if ($this->canTransition($currentStateDto)) {
            return $stateInstance->nextState();
        }

        return null;
    }

    /**
     * @param  \App\DTOs\CurrentStateDto  $currentStateDto
     * @return \App\Services\TrafficLightStateMachine\Contracts\BaseState
     * @throws \App\Services\TrafficLightStateMachine\Exceptions\EnumCaseValuesException
     */
    public function getCurrentState(Data $currentStateDto): BaseState
    {
        return StateMachineContextEnum::getCase($currentStateDto->currentState)->stateInstance();
    }

    /**
     * @throws \App\Services\TrafficLightStateMachine\Exceptions\EnumCaseValuesException
     */
    public function beginTransitions(string $stateAlias): BaseState
    {
        return StateMachineContextEnum::getCase($stateAlias)->stateInstance();
    }

    /**
     * @param  \App\DTOs\CurrentStateDto  $currentStateDto
     * @return bool
     */
    public function canTransition(Data $currentStateDto): bool
    {
        return time() >= ($currentStateDto->duration + $currentStateDto->startTime);
    }
}