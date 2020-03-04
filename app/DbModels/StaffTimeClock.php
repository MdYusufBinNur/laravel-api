<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StaffTimeClock extends Model
{
    use CommonModelFeatures;

    const STATE_CHECK_IN = 'check-in';
    const STATE_CHECK_OUT = 'check-out';
    const STATE_BREAK_IN = 'break-in';
    const STATE_BREAK_OUT = 'break-out';
    const STATE_OVERTIME_IN = 'overtime-in';
    const STATE_OVERTIME_OUT = 'overtime-out';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manager_time_clocks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'propertyId', 'managerId', 'state', 'createdByUserId', 'clockedIn', 'clockedOut', 'clockInNote', 'clockOutNote', 'timeClockInDeviceId', 'timeClockOutDeviceId'
    ];

    /**
     * get the property
     *
     * @return hasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the visitor image
     *
     * @return hasOne
     */
    public function clockInPhoto()
    {
        return $this->hasOne(Attachment::class, 'resourceId', 'id')->where('type',Attachment::ATTACHMENT_TYPE_STAFF_TIME_CLOCK_IN);
    }

    /**
     * get the visitor image
     *
     * @return hasOne
     */
    public function clockOutPhoto()
    {
        return $this->hasOne(Attachment::class, 'resourceId', 'id')->where('type',Attachment::ATTACHMENT_TYPE_STAFF_TIME_CLOCK_OUT);
    }

    /**
     * user and manager relationship
     *
     * @return HasOne
     */
    public function manager()
    {
        return $this->hasOne(Manager::class, 'id', 'managerId');
    }

    /**
     * get the TimeClockDevice for clock-in
     *
     * @return hasOne
     */
    public function timeClockInDevice()
    {
        return $this->hasOne(TimeClockDevice::class, 'id', 'timeClockInDeviceId');
    }

    /**
     * get the TimeClockDevice for clock-out
     *
     * @return hasOne
     */
    public function timeClockOutDevice()
    {
        return $this->hasOne(TimeClockDevice::class, 'id', 'timeClockOutDeviceId');
    }


}
