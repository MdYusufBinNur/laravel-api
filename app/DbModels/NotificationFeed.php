<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class NotificationFeed extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'userId', 'name', 'content', 'isRead', 'isViewed'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isRead' => 'boolean',
        'isViewed' => 'boolean',
    ];
}
