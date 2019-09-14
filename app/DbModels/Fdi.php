<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Fdi extends Model
{
    use CommonModelFeatures;

    const TYPE_GUEST = 'guest';
    const TYPE_MAIL = 'mail';
    const TYPE_GENERAL = 'general';

    const STATUS_ACTIVE = 'active';
    const STATUS_DELETED = 'deleted';
    const STATUS_PENDING_APPROVAL = 'pending-approval';

    const VISITOR_TYPE_GUEST = 'guest';
    const VISITOR_TYPE_FAMILY = 'family';
    const VISITOR_TYPE_CONTRACTOR = 'contractor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'unitId', 'type', 'visitorType', 'name', 'photo', 'startDate', 'endDate', 'permanent', 'comments', 'canGetKey', 'signature', 'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'photo' => 'boolean',
        'permanent' => 'boolean',
        'canGetKey' => 'boolean',
        'signature' => 'boolean',
        'startDate' => 'datetime',
        'endDate' => 'datetime',
    ];

    /**
     * set default values
     *
     * @var array
     */
    protected $attributes = [
        'status' => self::STATUS_ACTIVE,
    ];



    /**
     * get the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    /**
     * get the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unitId');
    }

    /**
     * get the property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function property()
    {
        return $this->hasOne(Unit::class, 'id', 'unitId');
    }
}
