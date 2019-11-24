<?php

namespace App\Http\Requests\InventoryItem;

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
            'propertyId' => 'required|exists:properties,id',
            'categoryId' => 'required|exists:inventory_categories,id',
            'sku' => 'max:255',
            'name' => 'required|max:255',
            'description' => 'max:65535',
            'location' => 'max:255',
            'quantity' => 'max:255',
            'comment' => 'max:255',
            'manufacturer' => 'max:255',
            'restockNote' => 'max:255',
            'notifyCount' => 'numeric',
        ];
    }
}
