<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class StaffTimeClockDevice extends Model
{
    use CommonModelFeatures;

    protected $table = 'manager_time_clock_devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'deviceSN', 'location'
    ];
}
