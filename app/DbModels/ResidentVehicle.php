<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ResidentVehicle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'resident_id', 'make', 'model', 'color', 'license_plate'
    ];
}
