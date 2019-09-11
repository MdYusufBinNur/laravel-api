<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use CommonModelFeatures;

    const FEEDBACK_NONE = 'none';
    const FEEDBACK_POSITIVE = 'positive';
    const FEEDBACK_NEGATIVE = 'negative';

    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_ON_HOLD = 'on_hold';
    const STATUS_CANCELLED = 'canceled';
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(ServiceRequestMessage::class, 'serviceRequestId', 'id');
    }

    /**
     * service request and its log relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(ServiceRequestLog::class, 'serviceRequestId', 'id');
    }

}
