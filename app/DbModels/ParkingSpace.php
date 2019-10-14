<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ParkingSpace extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'parkingNumber', 'ownedBy'
    ];
}
