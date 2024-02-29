<?php

namespace App\Services\Contracts;

interface TrafficLightServiceInterface extends ServiceInterface
{
    public function trafficLightClock(): void;

    public function startDriving();

}