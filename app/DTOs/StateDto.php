<?php

namespace App\DTOs;

use Spatie\LaravelData\Data;

class StateDto extends Data
{
    public function __construct(
        public int $duration,
        public string $class,
        public string $transition
    ) {
    }
}
