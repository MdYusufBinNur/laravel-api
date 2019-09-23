<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use CommonModelFeatures;

    const STATUS_ACTIVE = 'active';
    const STATUS_ARCHIVE = 'archive';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'signInUserId', 'unitId', 'visitorTypeId', 'name', 'phone', 'email', 'company', 'photo', 'permanent', 'comment', 'signature', 'status', 'signInAt'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'photo' => 'boolean',
        'permanent' => 'boolean',
        'signature' => 'boolean',
        'signInAt' => 'datetime:Y-m-d h:i',
    ];


    /**
     * get the property
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unitId');
    }

    /**
     * get the visitor type
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function visitorType()
    {
        return $this->hasOne(Visitor::class, 'id', 'visitorTypeId');
    }

    /**
     * get the sign in user
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function signInUser()
    {
        return $this->hasOne(User::class, 'id', 'signInUserId');
    }
}
