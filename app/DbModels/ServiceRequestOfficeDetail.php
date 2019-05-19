<?php

namespace App\DbModels;

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
        'serviceRequestId', 'assignedUserId', 'materialUsed', 'materialAmount', 'handyman', 'outsideContactor', 'partsNeeded', 'comments', 'temporarilyRepaired', 'signature', 'createdByUserId'
    ];
}
