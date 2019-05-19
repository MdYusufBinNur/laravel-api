<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ResidentEmergency extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'residentId', 'name', 'relationship', 'address', 'homePhone', 'cellPhone', 'email'
    ];
}
