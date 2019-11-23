<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{

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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }
}
