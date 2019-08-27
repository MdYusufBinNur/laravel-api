<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ServiceRequestLog extends Model
{
    use CommonModelFeatures;

    const TYPE_STATUS = 'status';
    const TYPE_COMMENT = 'comment';
    const TYPE_FEEDBACK = 'feedback';
    const TYPE_ASSIGNMENT = 'assignment';

    const FEEDBACK_NONE = 'none';
    const FEEDBACK_POSITIVE = 'positive';
    const FEEDBACK_NEGATIVE = 'negative';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId', 'comments', 'feedback', 'type', 'status', 'createdByUserId'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];
}
