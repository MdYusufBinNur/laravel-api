<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use CommonModelFeatures;

    const GROUP_ENTIRE_COMMUNITY = 'entire_community';
    const GROUP_REGISTERED_USERS = 'registered_users';
    const GROUP_UNREGISTERED_USERS = 'registered_users';
    const GROUP_ALL_STAFFS = 'all_staffs';
    const GROUP_SPECIFIC_TOWER = 'specific_tower';
    const GROUP_SPECIFIC_FLOOR = 'specific_floor';
    const GROUP_SPECIFIC_LINE = 'specific_line';
    const GROUP_TENANTS = 'specific_tenants';
    const GROUP_OWNERS = 'specific_owners';

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
