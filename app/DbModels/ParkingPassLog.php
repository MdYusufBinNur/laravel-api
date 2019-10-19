<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ParkingPassLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'passId', 'spaceId', 'make', 'model', 'licensePlate', 'startAt', 'endAt', 'releasedAt', 'event',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'startAt' => 'datetime:Y-m-d h:i',
        'endAt' => 'datetime:Y-m-d h:i',
        'releasedAt' => 'datetime:Y-m-d h:i',
    ];
}
