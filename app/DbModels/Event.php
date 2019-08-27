<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'createdUserId', 'title', 'text', 'maxGuests', 'allowedSignUp', 'alldayEvent', 'allowedLoginPage', 'hasAttachment', 'startAt', 'endAt'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'allowedSignUp' => 'boolean',
        'alldayEvent' => 'boolean',
        'allowedLoginPage' => 'boolean',
        'hasAttachment' => 'boolean',
        'startAt' => 'datetime:Y-m-d h:i',
        'endAt' => 'datetime:Y-m-d h:i',
    ];
}
