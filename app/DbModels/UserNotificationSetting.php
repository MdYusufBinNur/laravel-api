<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserNotificationSetting extends Model
{
    use CommonModelFeatures;

    const TYPE_DAILY_DIGEST = ['id' => 1, 'title' => 'Send a Daily Activity Digest'];
    const TYPE_LEAVE_NOTE = ['id' => 2, 'title' => 'Someone leaves me a note'];
    const TYPE_DELIVERY_PICKUP = ['id' => 3, 'title' => 'A delivery is ready for Pickup'];
    const TYPE_SERVICE_REQUEST = ['id' => 4, 'title' => 'This is an update with my service requests'];
    const TYPE_RETURN_MY_KEY = ['id' => 5, 'title' => 'Someone checks out or return my Key'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'userId', 'email', 'sms', 'type', 'voice'
    ];
}
