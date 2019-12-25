<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MessagePost extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'messageId', 'fromUserId', 'text'
    ];

    /**
     * get the user
     *
     * @return HasOne
     */
    public function fromUser()
    {
        return $this->hasOne(User::class, 'id', 'fromUserId');
    }

    /**
     * get the user
     *
     * @return hasOne
     */
    public function message()
    {
        return $this->hasOne(Message::class, 'id', 'messageId');
    }

    /**
     * @return HasMany
     */
    public function messageUsers()
    {
        return $this->hasMany(MessageUser::class, 'messageId', 'messageId');
    }

    /**
     * get the attachments
     *
     * @return HasMany
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'resourceId')->where('type', Attachment::ATTACHMENT_TYPE_MESSAGE_POST);
    }
}
