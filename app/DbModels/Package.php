<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'unitId', 'residentId', 'typeId', 'enteredUserId', 'trackingNumber', 'comments', 'notifiedByEmail', 'notifiedByText', 'notifiedByVoice'
    ];
}
