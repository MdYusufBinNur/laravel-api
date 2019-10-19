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
        'createdByUserId', 'propertyId', 'spaceId', 'unitId', 'make', 'model', 'licensePlate', 'startAt', 'endAt', 'releasedAt', 'releasedByUserId'
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
     * get the property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function property()
    {
        return $this->hasOne(User::class, 'id', 'propertyId');
    }

    /**
     * get the released by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function releasedByUser()
    {
        return $this->hasOne(User::class, 'id', 'releasedByUserId');
    }

    /**
     * get the parking space
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parkingSpace()
    {
        return $this->hasOne(ParkingSpace::class, 'id', 'spaceId');
    }


    /**
     * get the unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unitId');
    }


}
