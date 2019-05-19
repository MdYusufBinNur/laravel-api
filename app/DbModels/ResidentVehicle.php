<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ResidentVehicle extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'residentId', 'make', 'model', 'color', 'licensePlate'
    ];
}
