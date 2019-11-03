<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
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
        'notifyCount'
    ];
}
