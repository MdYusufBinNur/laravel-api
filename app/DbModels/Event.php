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
}
