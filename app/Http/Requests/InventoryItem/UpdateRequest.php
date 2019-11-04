<?php

namespace App\Http\Requests\InventoryItem;

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
            'propertyId' => 'exists:properties,id',
            'categoryId' => 'exists:inventory_categories,id',
            'sku' => 'min:2|max:255',
            'name' => 'min:2|max:255',
            'description' => 'min:2|max:65535',
            'location' => 'min:2|max:255',
            'quantity' => 'min:1|max:255',
            'comment' => 'min:2|max:255',
            'manufacturer' => 'min:2|max:255',
            'notifyCount' => 'numeric',
        ];
    }
}
