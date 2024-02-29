<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TrafficLog
 *
 * @method static Builder|TrafficLog newModelQuery()
 * @method static Builder|TrafficLog newQuery()
 * @method static Builder|TrafficLog query()
 * @mixin \Eloquent
 */
class TrafficLog extends Model
{
    use HasFactory;

    protected $table = 'traffic_log';

    public $timestamps = ['created_at'];

    const UPDATED_AT = null;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'message',
        'state',
    ];
}
