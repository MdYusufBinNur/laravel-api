<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Package extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'unitId', 'propertyId', 'residentId', 'typeId', 'enteredUserId', 'trackingNumber', 'description', 'comment', 'notifiedByEmail', 'notifiedByText', 'notifiedByVoice'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'notifiedByEmail' => 'boolean',
        'notifiedByText' => 'boolean',
        'notifiedByVoice' => 'boolean',
    ];

    /**
     * user and enterprise user relationship
     *
     * @return HasOne
     */
    public function unit()
    {
        return $this->hasOne(Unit::class,'id','unitId');
    }

    /**
     * user and enterprise user relationship
     *
     * @return HasOne
     */
    public function resident()
    {
        return $this->hasOne(Resident::class,'id','residentId');
    }

    /**
     * resident and user relationship
     *
     * @return HasOneThrough
     */
    public function user()
    {
        return $this->hasOneThrough(User::class, Resident::class,'id','id', 'residentId', 'userId');
    }

    /**
     * get entered user
     *
     * @return HasOne
     */
    public function enteredUser()
    {
        return $this->hasOne(User::class,'id','enteredUserId');
    }

    /**
     * user and enterprise user relationship
     *
     * @return HasOne
     */
    public function type()
    {
        return $this->hasOne(PackageType::class,'id','typeId');
    }

    /**
     * get the property
     *
     * @return hasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

}
