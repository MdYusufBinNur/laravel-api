<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class InventoryItemLog extends Model
{
    protected $fillable = [
        'inventoryItemId',
        'propertyId',
        'updatedByUserId',
        'QuantityChange'
    ];
}
