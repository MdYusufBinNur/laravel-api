<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class EventSignup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'event_id', 'user_id', 'resident_id', 'guests'
    ];
}
