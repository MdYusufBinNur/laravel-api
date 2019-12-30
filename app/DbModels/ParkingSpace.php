<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
     * @return HasOne
     */
    public function ownerUser()
    {
        return $this->hasOne(User::class, 'id', 'ownerUserId');
    }

    /**
     * get the property
     *
     * @return HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the currently assigned pass
     *
     * @return HasOne
     */
    public function currentlyAssignedPass()
    {
        return $this->hasOne(ParkingPass::class, 'spaceId', 'id')->whereNull('releasedAt');
    }
}
