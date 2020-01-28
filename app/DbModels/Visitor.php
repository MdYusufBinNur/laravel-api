<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'createdByUserId', 'propertyId', 'signInUserId', 'unitId', 'userId', 'visitorTypeId', 'name', 'phone', 'email', 'company', 'photo', 'permanent', 'comment', 'signature', 'status', 'signInAt'
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
     * @return hasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the unit
     *
     * @return hasOne
     */
    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unitId');
    }

    /**
     * get the unit
     *
     * @return hasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    /**
     * get the visitor type
     *
     * @return hasOne
     */
    public function visitorType()
    {
        return $this->hasOne(VisitorType::class, 'id', 'visitorTypeId');
    }

    /**
     * get the sign in user
     *
     * @return hasOne
     */
    public function signInUser()
    {
        return $this->hasOne(User::class, 'id', 'signInUserId');
    }

    /**
     * get the visitor image
     *
     * @return hasOne
     */
    public function image()
    {
        return $this->hasOne(Attachment::class, 'resourceId', 'id')->where('type',Attachment::ATTACHMENT_TYPE_VISITOR);
    }
}
