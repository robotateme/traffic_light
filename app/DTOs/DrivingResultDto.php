<?php

namespace App\DTOs;

use Spatie\LaravelData\Data;

class DrivingResultDto extends Data
{
    public function __construct(
        public string $message,
        public string $state,
    ) {
    }
}
