<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $fillable = [
        'createdByUserId', 'toUserId', 'fromUserId', 'userNotificationTypeId', 'resourceId', 'message', 'readStatus'
    ];
}
