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
            'sku' => 'list:string',
            'name' => 'list:string',
            'location' => 'list:string',
            'quantity' => 'list:numeric',
            'manufacturer' => 'list:string',
            'notifyCount' => 'list:numeric',
            'startDate' => 'date_format:Y-m-d',
            'endDate' => 'date_format:Y-m-d',
        ];
    }
}
