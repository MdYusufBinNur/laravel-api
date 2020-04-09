<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InventoryItemLog extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inventoryItemId',
        'propertyId',
        'updatedByUserId',
        'QuantityChange',
        'vendorId',
        'expenseId',
        'cost',
        'description',
    ];

    /**
     * get the inventory item
     *
     * @return HasOne
     */
    public function inventoryItem()
    {
        return $this->hasOne(InventoryItem::class, 'id', 'inventoryItemId');
    }

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
     * get the updated by user
     *
     * @return HasOne
     */
    public function updatedByUser()
    {
        return $this->hasOne(User::class, 'id', 'updatedByUserId');
    }

    /**
     * get the vendor
     *
     * @return HasOne
     */
    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendorId');
    }

    /**
     * get the expense
     *
     * @return HasOne
     */
    public function expense()
    {
        return $this->hasOne(Expense::class, 'id', 'expenseId');
    }

}
