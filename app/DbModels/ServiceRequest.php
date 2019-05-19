<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use CommonModelFeatures;

    const TYPE_UNIT = 'unit';
    const TYPE_COMMON_AREA = 'commonArea';
    const TYPE_EQUIPMENT = 'equipment';

    const FEEDBACK_NONE = 'none';
    const FEEDBACK_POSITIVE = 'positive';
    const FEEDBACK_NEGATIVE = 'negative';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId', 'unitId', 'categoryId', 'statusId', 'type', 'phone', 'description', 'permissionToEnter', 'prefferedStartTime', 'prefferedEndTime', 'feedback', 'photo', 'resolvedAt', 'createdByUserId'
    ];
}
