<?php

namespace App\Http\Requests\InventoryItemLog;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'inventoryItemId' => 'exists:inventory_items,id',
            'propertyId' => 'exists:properties,id',
            'updatedByUserId' => 'exists:users,id',
            'QuantityChange' => 'min:2|max:255',
        ];
    }
}
