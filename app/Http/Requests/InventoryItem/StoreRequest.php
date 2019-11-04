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
            'sku' => 'required|min:2|max:255',
            'name' => 'required|min:2|max:255',
            'description' => 'required|min:2|max:65535',
            'location' => 'required|min:2|max:255',
            'quantity' => 'required|min:1|max:255',
            'comment' => 'required|min:2|max:255',
            'manufacturer' => 'required|min:2|max:255',
            'notifyCount' => 'required|numeric',
        ];
    }
}
