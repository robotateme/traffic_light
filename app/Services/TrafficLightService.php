<?php

namespace App\Services;

use App\DTOs\CurrentStateDto;
use App\DTOs\DrivingResultDto;
use App\Events\LightSwitched;
use App\Repositories\Contracts\TrafficLogRepositoryInterface;
use App\Repositories\TrafficLightCacheRepository;
use App\Services\Contracts\TrafficLightServiceInterface;
use App\Services\TrafficLightStateMachine\Contracts\StateMachineInterface as TrafficLightSMInterface;
use Spatie\LaravelData\Data;

class TrafficLightService implements TrafficLightServiceInterface
{

    /**
     * @param  \App\Services\TrafficLightStateMachine\StateMachine  $trafficLightSM
     * @param  \App\Repositories\TrafficLightCacheRepository  $lightCacheRepository
     * @param  \App\Repositories\Contracts\TrafficLogRepositoryInterface  $trafficLogRepository
     */
    public function __construct(
        private readonly TrafficLightSMInterface $trafficLightSM,
        private readonly TrafficLightCacheRepository $lightCacheRepository,
        private readonly TrafficLogRepositoryInterface $trafficLogRepository
    )
    {

    }

    /**
     * @throws \Exception
     * Выполняет раз в секунду с опросом на смену состояния светофора.
     * Объявляет событие, о смене состояния.
     */
    public function trafficLightClock(): void
    {
        $currentState = $this->lightCacheRepository->getCurrent();

        if ($currentState) {
            $stateInstance = $this->trafficLightSM->doTransition($currentState);
        } else {
            $stateInstance = $this->trafficLightSM->beginTransitions('pedestrian_yellow');
        }

        if ($stateInstance) {
            $dto = new CurrentStateDto(
                $stateInstance->duration,
                time(),
                $stateInstance->alias
            );

            $this->lightCacheRepository->create($dto);
            event(new LightSwitched($dto->toArray()));
        }
    }


    /**
     * @return DrivingResultDto|null
     * @throws \App\Services\TrafficLightStateMachine\Exceptions\EnumCaseValuesException
     */
    public function startDriving(): ?Data
    {
        $currentState = $this->lightCacheRepository->getCurrent();
        if (!is_null($currentState)) {
            $stateInstance = $this->trafficLightSM->getCurrentState($currentState);

            $dto = DrivingResultDto::from([
                'message' => $stateInstance->handle(),
                'state' => $stateInstance->alias
            ]);

            $this->trafficLogRepository->create($dto);
            return $dto;
        }

        return null;
    }
}