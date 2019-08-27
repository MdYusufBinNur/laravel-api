<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ParkingPass extends Model
{
    use CommonModelFeatures;

    const TYPE_UNIT = 'unit';
    const TYPE_OFFICE = 'office';

    const STATUS_ACTIVE = 'active';
    const STATUS_VOIDED = 'voided';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'unitId', 'submittedUserId', 'voidedUserId', 'number', 'type', 'status', 'vehicleMake', 'vehicleModel', 'vehicleLicensePlate', 'otherDetail', 'startAt', 'endAt', 'voidedAt'
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
