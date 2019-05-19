<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ResidentArchive extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'residentId', 'unitId', 'startAt', 'endAt'
    ];
}
