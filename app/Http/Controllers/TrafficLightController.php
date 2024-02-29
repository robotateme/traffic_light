<?php

namespace App\Http\Controllers;

use App\Http\Resources\TrafficLogResource;
use App\Models\TrafficLog;
use App\Services\Contracts\TrafficLightServiceInterface;
use Illuminate\Http\JsonResponse;

class TrafficLightController extends Controller
{
    /**
     * @param  \App\Services\Contracts\TrafficLightServiceInterface  $trafficLightService
     */
    public function __construct(private readonly TrafficLightServiceInterface $trafficLightService)
    {
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function startDriving(): JsonResponse
    {
        return response()->json([
            'result' => $this->trafficLightService->startDriving()
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function log(): JsonResponse
    {
        return response()->json(
            [
                'data' => new TrafficLogResource(TrafficLog::limit(25)->orderBy('id', 'DESC')->get())
            ]
        );
    }
}