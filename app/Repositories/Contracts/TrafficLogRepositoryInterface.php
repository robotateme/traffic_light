<?php

namespace App\Repositories\Contracts;

use Spatie\LaravelData\Data;

interface TrafficLogRepositoryInterface extends RepositoryInterface
{
    public function create(Data $dto): Data;
}