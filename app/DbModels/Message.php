<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use CommonModelFeatures;

    const GROUP_ENTIRE_PROPERTY = 'entire_property';
    const GROUP_ALL_RESIDENTS = 'all_residents';
    const GROUP_UNREGISTERED_USERS = 'registered_users';
    const GROUP_ALL_STAFFS = 'all_staffs';
    const GROUP_SPECIFIC_TOWER = 'specific_tower';
    const GROUP_SPECIFIC_FLOOR = 'specific_floor';
    const GROUP_SPECIFIC_LINE = 'specific_line';
    const GROUP_SPECIFIC_UNITS = 'specific_unit';
    const GROUP_ALL_TENANTS = 'all_tenants';
    const GROUP_ALL_OWNERS = 'all_owners';

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

    /**
     * get the property related to the user's role
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the message post related the message
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function messagePost()
    {
        return $this->hasOne(MessagePost::class, 'messageId', 'id');
    }

    /**
     * user and messages_users relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messageUsers()
    {
        return $this->hasMany(MessageUser::class, 'messageId', 'id');
    }

    /**
     * get the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fromUser()
    {
        return $this->hasOne(User::class, 'id', 'fromUserId');
    }

    /**
     * user and to message users relationships
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function toUsers()
    {
        return $this->messageUsers()->where('userId', '<>', $this->createdByUserId);
    }
}
