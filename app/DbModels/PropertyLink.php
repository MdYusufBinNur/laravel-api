<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PropertyLink extends Model
{
    use CommonModelFeatures;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'title', 'url', 'description', 'iconName', 'isFeatured', 'linkCategoryId'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isFeatured' => 'boolean',
    ];

    /**
     * get the category
     *
     * @return HasOne
     */
    public function linkCategory()
    {
        return $this->hasOne(PropertyLinkCategory::class, 'id', 'linkCategoryId');
    }
}
