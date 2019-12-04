<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
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

    /**
     * get the event
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function event()
    {
        return $this->hasOne(Event::class, 'id', 'eventId');
    }

    /**
     * get the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    /**
     * get the resident
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function resident()
    {
        return $this->hasOne(Resident::class, 'id', 'residentId');
    }
}
