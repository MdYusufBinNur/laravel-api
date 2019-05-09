<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class NotificationFeed extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'user_id', 'name', 'content', 'is_read', 'is_viewed'
    ];
}
