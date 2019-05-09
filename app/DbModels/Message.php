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
        'createdByUserId', 'property_id', 'from_user_id', 'to_user_id', 'subject', 'is_group_message', 'group', 'group_names', 'email_notification', 'sms_notification', 'voice_notification'
    ];
}
