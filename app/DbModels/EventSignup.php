<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class EventSignup extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'eventId', 'userId', 'residentId', 'guests'
    ];
}
