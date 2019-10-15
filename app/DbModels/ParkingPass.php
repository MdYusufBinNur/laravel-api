<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ParkingPass extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'unitId', 'make', 'model', 'licensePlate', 'startAt', 'endAt', 'voidedAt'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'startAt' => 'datetime:Y-m-d h:i',
        'endAt' => 'datetime:Y-m-d h:i',
        'voidedAt' => 'datetime:Y-m-d h:i',
    ];
}
