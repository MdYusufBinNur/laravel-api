<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ServiceRequestLog extends Model
{
    use CommonModelFeatures;

    const TYPE_CREATED = 'created';
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
        'userId', 'serviceRequestId', 'serviceRequestMessageId', 'feedback', 'type', 'status', 'createdByUserId'
    ];

    /**
     * service request
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function serviceRequest()
    {
        return $this->hasOne(ServiceRequest::class, 'id', 'serviceRequestId');
    }

    /**
     * service request and its message
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function message()
    {
        return $this->hasOne(ServiceRequestMessage::class, 'id', 'serviceRequestMessageId');
    }

    /**
     * get the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }
}
