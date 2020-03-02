<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class TimeClockDevice extends Model
{
    use CommonModelFeatures;

    protected $table = 'time_clock_devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'deviceSN', 'location'
    ];
}
