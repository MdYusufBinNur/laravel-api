<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ParkingSpace extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'parkingNumber', 'ownerUserId', 'ownedBy', 'address', 'email', 'phone'
    ];

    /**
     * get the owner user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ownerUser()
    {
        return $this->hasOne(User::class, 'id', 'ownerUserId');
    }

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
     * get the currently assigned pass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currentlyAssignedPass()
    {
        return $this->hasOne(ParkingPass::class, 'spaceId', 'id')->whereNull('releasedAt');
    }
}
