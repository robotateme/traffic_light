<?php

namespace App\Services\TrafficLightStateMachine\Enums;

use App\DTOs\StateDto;
use App\Services\TrafficLightStateMachine\Contracts\BaseState;
use App\Services\TrafficLightStateMachine\Enums\Contracts\StateMachineContextEnumInterface;
use App\Services\TrafficLightStateMachine\Enums\Contracts\StatesEnumInterface;
use App\Services\TrafficLightStateMachine\Enums\Traits\GetCaseTrait;
use App\Services\TrafficLightStateMachine\States\DriverYellowState;
use App\Services\TrafficLightStateMachine\States\GreenState;
use App\Services\TrafficLightStateMachine\States\RedState;
use Spatie\LaravelData\Data;

enum StateMachineContextEnum: string implements StatesEnumInterface, StateMachineContextEnumInterface
{
    case Green = 'green';
    case Red = 'red';
    case PedestrianYellow = 'pedestrian_yellow';
    case DriverYellow = 'driver_yellow';

    use GetCaseTrait;

    /**
     * @throws \App\Services\TrafficLightStateMachine\Exceptions\EnumCaseValuesException
     */
    private static function getStateInstance(string $alias): BaseState
    {
        $rules = self::getCase($alias)?->rules();
        return new $rules->class($alias, $rules->duration, $rules->transition);
    }

    /**
     * @inheritDoc
     */
    public function stateInstance(): BaseState
    {
        return match ($this) {
            self::Green => self::getStateInstance(self::Green->value),
            self::Red => self::getStateInstance(self::Red->value),
            self::PedestrianYellow => self::getStateInstance(self::PedestrianYellow->value),
            self::DriverYellow => self::getStateInstance(self::DriverYellow->value),
        };
    }

    /**
     * @return string
     */
    public function color(): string
    {
        return match ($this) {
            self::Green => 'green',
            self::Red => 'red',
            self::PedestrianYellow, self::DriverYellow => 'yellow',
        };
    }

    /**
     * @return StateDto
     */
    private function rules(): Data
    {
        return match ($this) {
            self::Green => StateDto::from(
                [
                    'duration' => 5,
                    'transition' => 'driver_yellow',
                    'class' => GreenState::class,
                ]
            ),
            self::Red => StateDto::from(
                [
                    'duration' => 5,
                    'transition' => 'pedestrian_yellow',
                    'class' => RedState::class,
                ]
            ),
            self::PedestrianYellow => StateDto::from(
                [
                    'duration' => 2,
                    'transition' => 'green',
                    'class' => DriverYellowState::class,
                ]
            ),
            self::DriverYellow => StateDto::from(
                [
                    'duration' => 2,
                    'transition' => 'red',
                    'class' => DriverYellowState::class,
                ]
            ),
        };
    }

    public function message(): string
    {
        return match ($this) {
            self::Green => 'Проезд на зеленый!',
            self::Red => 'Проезд на красный. Штраф!',
            self::PedestrianYellow => 'Слишком рано начали движение!',
            self::DriverYellow => 'Успели на желтый!',
        };
    }
}
