<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * get the User who will received the notification
     *
     * @return HasOne
     */
    public function toUser()
    {
        return $this->hasOne(User::class, 'id', 'toUserId');
    }

    /**
     * get the User who sent the notification
     *
     * @return HasOne
     */
    public function fromUser()
    {
        return $this->hasOne(User::class, 'id', 'fromUserId');
    }

    /**
     * get the UserNotificationType
     *
     * @return HasOne
     */
    public function type()
    {
        return $this->hasOne(UserNotificationType::class, 'id', 'userNotificationTypeId');
    }
}
