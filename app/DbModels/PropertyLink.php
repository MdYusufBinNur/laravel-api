<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class PropertyLink extends Model
{
    use CommonModelFeatures;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'title', 'url', 'description', 'isFeatured', 'linkCategoryId'
    ];

    /**
     * get the category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function linkCategory()
    {
        return $this->hasOne(PropertyLinkCategory::class, 'id', 'linkCategoryId');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isFeatured' => 'boolean',
    ];

}
