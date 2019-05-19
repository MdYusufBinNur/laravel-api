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
        'user_id', 'unit_id', 'category_id', 'status_id', 'type', 'phone', 'description', 'permission_to_enter', 'preffered_start_time', 'preffered_end_time', 'feedback', 'photo', 'resolved_at', 'createdByUserId'
    ];
}
