<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserNotificationSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'user_id', 'email', 'sms', 'type', 'voice'
    ];
}
