<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'title', 'content', 'link', 'linkinNewWindows', 'showOnWebsite', 'showOnLds', 'expireAt'
    ];
}
