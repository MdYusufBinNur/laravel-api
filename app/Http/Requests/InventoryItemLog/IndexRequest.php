<?php

namespace App\Http\Requests\InventoryItemLog;

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
            'inventoryItemId' => 'list:numeric',
            'propertyId' => 'required|numeric',
            'vendorId' => 'numeric',
            'updatedByUserId' => 'list:numeric',
            'startDate' => 'date_format:Y-m-d',
            'endDate' => 'date_format:Y-m-d',
        ];
    }
}
