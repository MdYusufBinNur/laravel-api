<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{

    /**
     * Table name
     * @var string
     */
    protected $table = 'user_notifications';

    protected $fillable = [
        'createdByUserId', 'toUserId', 'fromUserId', 'userNotificationTypeId', 'resourceId', 'message', 'readStatus'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'readStatus' => 'boolean',
    ];
}
