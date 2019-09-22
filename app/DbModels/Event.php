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
        'createdByUserId', 'propertyId', 'title', 'text', 'maxGuests', 'allowedSignUp', 'allDayEvent', 'allowedLoginPage', 'hasAttachment', 'startAt', 'endAt', 'date'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'allowedSignUp' => 'boolean',
        'allDayEvent' => 'boolean',
        'allowedLoginPage' => 'boolean',
        'hasAttachment' => 'boolean',
        'date' => 'datetime: Y-m-d h:i',
    ];

    /**
     * get the property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the attachments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'resourceId')->where('type', Attachment::ATTACHMENT_TYPE_EVENT);
    }
}
