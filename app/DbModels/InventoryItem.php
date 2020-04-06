<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InventoryItem extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'propertyId',
        'categoryId',
        'sku',
        'name',
        'description',
        'location',
        'quantity',
        'comment',
        'manufacturer',
        'restockNote',
        'notifyCount'
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

    /**
     * get the category
     *
     * @return HasOne
     */
    public function category()
    {
        return $this->hasOne(InventoryCategory::class, 'id', 'categoryId');
    }
}
