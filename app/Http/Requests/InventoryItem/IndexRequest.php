<?php

namespace App\Http\Requests\InventoryItem;

use App\Http\Requests\Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'list:numeric',
            'propertyId' => 'list:numeric',
            'categoryId' => 'list:numeric',
            'sku' => 'string',
            'name' => 'string',
            'location' => 'string',
            'quantity' => 'string',
            'manufacturer' => 'string',
            'notifyCount' => 'list:numeric',
        ];
    }
}
