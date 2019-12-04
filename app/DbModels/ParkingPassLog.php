<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class ParkingPassLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'passId', 'spaceId', 'unitId', 'make', 'model', 'licensePlate', 'startAt', 'endAt', 'releasedAt', 'event',
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

    /**
     * get the parking space
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parkingSpace()
    {
        return $this->hasOne(ParkingSpace::class, 'id', 'spaceId');
    }
}
