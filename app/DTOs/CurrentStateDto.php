<?php

namespace App\DTOs;

use App\Values\CurrentColorValue;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;

class CurrentStateDto extends Data
{
    /**
     * @throws \App\Services\TrafficLightStateMachine\Exceptions\EnumCaseValuesException
     */
    public function __construct(
        public int $duration,
        #[MapName('start_time')]
        public int $startTime,
        #[MapName('current_state')]
        public string $currentState,
        #[Computed]
        public ?string $currentColor = null,

    ) {
        $this->currentColor = new CurrentColorValue($this->currentState);
    }

    public function toArray(): array
    {
        return [
            'start_time' => $this->startTime,
            'current_state' => $this->currentState,
            'duration' => $this->duration,
            'current_light' => $this->currentColor
        ];
    }
}
