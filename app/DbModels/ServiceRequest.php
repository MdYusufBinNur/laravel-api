<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ServiceRequest extends Model
{
    use CommonModelFeatures;

    const FEEDBACK_NONE = 'none';
    const FEEDBACK_POSITIVE = 'positive';
    const FEEDBACK_NEGATIVE = 'negative';

    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_ON_HOLD = 'on_hold';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_RESOLVED = 'resolved';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'propertyId', 'userId', 'unitId', 'categoryId', 'status', 'type', 'phone', 'description', 'permissionToEnter', 'preferredStartTime', 'preferredEndTime', 'feedback', 'photo', 'resolvedAt', 'createdByUserId'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissionToEnter' => 'boolean',
        'photo' => 'boolean',
        'resolvedAt' => 'datetime:Y-m-d h:i',
    ];

    /**
     * set default values
     *
     * @var array
     */
    protected $attributes = [
        'status' => self::STATUS_NEW,
    ];


    /**
     * service request and its message relationship
     *
     * @return HasMany
     */
    public function messages()
    {
        return $this->hasMany(ServiceRequestMessage::class, 'serviceRequestId', 'id');
    }

    /**
     * service request and its log relationship
     *
     * @return HasMany
     */
    public function logs()
    {
        return $this->hasMany(ServiceRequestLog::class, 'serviceRequestId', 'id');
    }

    /**
     * user of the service request
     *
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    /**
     * unit of the service request
     *
     * @return HasOne
     */
    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unitId');
    }

    /**
     * category of the service request
     *
     * @return HasOne
     */
    public function serviceRequestCategory()
    {
        return $this->hasOne(ServiceRequestCategory::class, 'id', 'categoryId');
    }

    /**
     * get service request photos
     *
     * @return HasMany
     */
    public function serviceRequestPhotos()
    {
        return $this->hasMany(Attachment::class, 'resourceId')->where('type', Attachment::ATTACHMENT_TYPE_SERVICE_REQUEST);
    }
}
