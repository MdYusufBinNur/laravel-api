<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ServiceRequestMessage extends Model
{
    use CommonModelFeatures;

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

}
