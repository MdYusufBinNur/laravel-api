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
}
