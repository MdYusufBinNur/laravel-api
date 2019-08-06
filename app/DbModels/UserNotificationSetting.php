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
        'createdByUserId', 'userId', 'email', 'sms', 'typeId', 'voice'
    ];
}
