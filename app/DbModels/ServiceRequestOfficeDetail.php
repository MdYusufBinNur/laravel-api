<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class ServiceRequestOfficeDetail extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serviceRequestId', 'assignedUserId', 'materialUsed', 'materialAmount', 'handyman', 'outsideContractor', 'partsNeeded', 'comment', 'temporarilyRepaired', 'signature', 'createdByUserId'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'outsideContractor' => 'boolean',
        'temporarilyRepaired' => 'boolean',
        'signature' => 'boolean',
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
}
