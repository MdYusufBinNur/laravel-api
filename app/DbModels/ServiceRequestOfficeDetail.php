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
        'service_request_id', 'assigned_user_id', 'material_used', 'material_amount', 'handyman', 'outside_contactor', 'parts_needed', 'comments', 'temporarily_repaired', 'signature', 'createdByUserId'
    ];
}
