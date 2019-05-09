<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ParkingPass extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'unit_id', 'submitted_user_id', 'voided_user_id', 'number', 'type', 'status', 'vehicle_make', 'vehicle_model', 'vehicle_license_plate', 'other_detail', 'start_at', 'end_at', 'voided_at'
    ];
}
