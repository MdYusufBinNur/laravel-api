<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'fromUserId', 'toUserId', 'subject', 'isGroupMessage', 'group', 'groupNames', 'emailNotification', 'smsNotification', 'voiceNotification'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isGroupMessage' => 'boolean',
        'emailNotification' => 'boolean',
        'smsNotification' => 'boolean',
        'voiceNotification' => 'boolean',
    ];
}
