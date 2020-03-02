<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class StaffTimeClockDevice extends Model
{
    use CommonModelFeatures;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manager_time_clock_devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'propertyId', 'managerId', 'createdByUserId', 'timeClockDeviceId', 'pin'
    ];

}
