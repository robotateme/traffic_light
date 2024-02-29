<?php

namespace Database\Factories;

use App\Services\TrafficLightStateMachine\Enums\StateMachineContextEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrafficLog>
 */
class TrafficLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \App\Services\TrafficLightStateMachine\Exceptions\EnumCaseValuesException
     */
    public function definition(): array
    {
        $state = fake()->randomElement(StateMachineContextEnum::values());
        return [
            'state' => $state,
            'message' => StateMachineContextEnum::getCase($state)->message()
        ];
    }
}
