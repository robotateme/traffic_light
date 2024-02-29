<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @property mixed $message
 * @property mixed $created_at
 */
class TrafficLogResource extends JsonResource
{
    public static $wrap = 'data';

    public function toArray(Request $request): array|JsonSerializable|Arrayable
    {
        return parent::toArray($request); // TODO: Change the autogenerated stub
    }
}
