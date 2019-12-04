<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class ServiceRequestMessage extends Model
{
    use CommonModelFeatures;

    const TYPE_COMMENT = 'comment';
    const TYPE_FEEDBACK = 'feedback';

    /**
     * Table name
     * @var string
     */
    protected $table = 'service_request_messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'serviceRequestId', 'userId', 'unitId', 'text', 'type', 'readStatus'
    ];

    /**
     * get the service request
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function serviceRequest()
    {
        return $this->hasOne(ServiceRequest::class, 'id', 'serviceRequestId');
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
