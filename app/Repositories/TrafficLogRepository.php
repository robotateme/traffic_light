<?php

namespace App\Repositories;

use App\DTOs\DrivingResultDto;
use App\Models\TrafficLog;
use App\Repositories\Contracts\TrafficLogRepositoryInterface;
use Illuminate\Database\Query\Builder;
use Spatie\LaravelData\Data;

class TrafficLogRepository implements TrafficLogRepositoryInterface
{
    /**
     * @param  \Spatie\LaravelData\Data  $dto
     * @return DrivingResultDto
     */
    public function create(Data $dto): Data
    {
        return DrivingResultDto::from(
            TrafficLog::create($dto->toArray())
        );
    }

    /**
     * @param  int  $limit
     * @return \Illuminate\Database\Query\Builder
     */
    public function getAll(int $limit): Builder
    {
        return TrafficLog::limit($limit);
    }
}