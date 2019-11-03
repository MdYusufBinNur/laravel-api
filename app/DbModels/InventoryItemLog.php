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
}
