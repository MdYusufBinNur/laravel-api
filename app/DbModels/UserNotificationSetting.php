<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserNotificationSetting extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'userId', 'email', 'sms', 'typeId', 'voice'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email' => 'boolean',
        'sms' => 'boolean',
        'voice' => 'boolean',
    ];
}
