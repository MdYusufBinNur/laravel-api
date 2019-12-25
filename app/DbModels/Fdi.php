<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Fdi extends Model
{
    use CommonModelFeatures;

    const TYPE_GUEST = 'guest';
    const TYPE_MAIL = 'mail';
    const TYPE_GENERAL = 'general';

    const STATUS_ACTIVE = 'active';
    const STATUS_DELETED = 'deleted';
    const STATUS_PENDING_APPROVAL = 'pending';
    const STATUS_DENIED = 'denied';
    const STATUS_EXPIRED = 'expired';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'unitId', 'type', 'guestTypeId', 'name', 'photo', 'startDate', 'endDate', 'permanent', 'comment', 'canGetKey', 'signature', 'status'
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
     * get the unit
     *
     * @return HasOne
     */
    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unitId');
    }

    /**
     * get the property
     *
     * @return HasOne
     */
    public function property()
    {
        return $this->hasOne(Unit::class, 'id', 'unitId');
    }

    /**
     * get the guest type
     *
     * @return HasOne
     */
    public function guestType()
    {
        return $this->hasOne(FdiGuestType::class, 'id', 'guestTypeId');
    }

    /**
     * service request and its log relationship
     *
     * @return HasMany
     */
    public function logs()
    {
        return $this->hasMany(FdiLog::class, 'fdiId', 'id');
    }

    /**
     * get service request photos
     *
     * @return HasMany
     */
    public function fdiImages()
    {
        return $this->hasMany(Attachment::class, 'resourceId')->where('type', Attachment::ATTACHMENT_TYPE_FDI);
    }
}
