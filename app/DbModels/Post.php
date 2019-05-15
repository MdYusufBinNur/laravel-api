<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use CommonModelFeatures;

    const TYPE_MARKETPLACE = 'marketplace';
    const TYPE_WALL = 'wall';
    const TYPE_RECOMMEND = 'recommend';
    const TYPE_EVENT = 'event';
    const TYPE_POLL = 'poll';

    const STATUS_POSTED = 'posted';
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_DENIED = 'denied';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'created_user_id', 'deleted_user_id', 'type', 'status', 'like_count', 'like_users', 'attachment'
    ];
}
