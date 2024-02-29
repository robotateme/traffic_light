<?php

namespace App\Repositories;

use App\DTOs\CurrentStateDto;
use App\Repositories\Contracts\CacheRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Spatie\LaravelData\Data;

class TrafficLightCacheRepository implements CacheRepositoryInterface
{
    const CACHE_KEY = 'traffic_light_data';

    /**
     * @param  \Spatie\LaravelData\Data  $currentStateDto
     * @return bool
     */
    public function update(Data $currentStateDto): bool
    {
        Cache::forget(self::CACHE_KEY);
        return Cache::set(self::CACHE_KEY, $currentStateDto->toArray(), 60);
    }

    /**
     * @param  CurrentStateDto  $currentStateDto
     * @return bool
     */
    public function create(Data $currentStateDto): bool
    {
        return Cache::put(self::CACHE_KEY, $currentStateDto->toArray(), 60);
    }

    /**
     * @param  string  $key
     * @return CurrentStateDto|null  $currentStateDto
     */
    public function getCurrent(string $key = self::CACHE_KEY): ?Data
    {
        $tlData = Cache::get($key);
        return $tlData ? CurrentStateDto::from($tlData) : null;
    }
}