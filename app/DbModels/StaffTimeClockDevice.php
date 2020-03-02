<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'propertyId', 'managerId', 'createdByUserId', 'timeClockDeviceId', 'timeClockDeviceUserId'
    ];

    /**
     * get the TimeClockDevice
     *
     * @return hasOne
     */
    public function timeClockDevice()
    {
        return $this->hasOne(TimeClockDevice::class, 'id', 'timeClockDeviceId');
    }

    /**
     * get the manager
     *
     * @return HasOne
     */
    public function manager()
    {
        return $this->hasOne(Manager::class, 'id', 'managerId');
    }

}
