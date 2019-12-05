<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'title', 'text', 'location', 'maxGuests', 'allowedSignUp', 'multipleDaysEvent', 'allowedLoginPage', 'hasAttachment', 'startAt', 'endAt', 'date', 'endDate'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'allowedSignUp' => 'boolean',
        'multipleDaysEvent' => 'boolean',
        'allowedLoginPage' => 'boolean',
        'hasAttachment' => 'boolean',
        'date' => 'datetime: Y-m-d h:i',
        'endDate' => 'datetime: Y-m-d h:i',
    ];

    /**
     * get the property
     *
     * @return HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the attachments
     *
     * @return HasMany
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'resourceId')->where('type', Attachment::ATTACHMENT_TYPE_EVENT);
    }

    /**
     * get the User who created the Event
     *
     * @return HasOne
     */
    public function createdByUser()
    {
        return $this->hasOne(User::class, 'id', 'createdByUserId');
    }

    /**
     * get the signups of this event
     *
     * @return HasMany
     */
    public function eventSignups()
    {
        return $this->hasMany(EventSignup::class, 'eventId');
    }
}
