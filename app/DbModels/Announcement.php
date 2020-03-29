<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'linkinNewWindows' => 'boolean',
        'showOnWebsite' => 'boolean',
        'showOnLds' => 'boolean',
        'expireAt' => 'datetime:Y-m-d h:i',
    ];

    /**
     * get the property
     *
     * @return HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

}
