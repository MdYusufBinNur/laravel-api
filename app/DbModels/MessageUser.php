<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class MessageUser extends Model
{
    use CommonModelFeatures;

    const FOLDER_INBOX = 'inbox';
    const FOLDER_SENT = 'sent';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'messageId', 'userId', 'folder', 'isRead'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isRead' => 'boolean',
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
     * get the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function message()
    {
        return $this->hasOne(Message::class, 'id', 'messageId');
    }

    /**
     * get the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }
}
