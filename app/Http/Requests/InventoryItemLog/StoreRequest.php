<?php

namespace App\Http\Requests\InventoryItemLog;

use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'inventoryItemId' => 'required|exists:inventory_items,id',
            'propertyId' => 'required|exists:properties,id',
            'updatedByUserId' => 'required|exists:users,id',
            'QuantityChange' => 'required|min:2|max:255',
        ];
    }
}
