<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class InventoryItemLog extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inventoryItemId',
        'propertyId',
        'updatedByUserId',
        'QuantityChange'
    ];

    /**
     * get the inventory item
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inventoryItem()
    {
        return $this->hasOne(InventoryItem::class, 'id', 'inventoryItemId');
    }

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
