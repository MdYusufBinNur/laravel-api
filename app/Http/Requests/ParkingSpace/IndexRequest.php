<?php

namespace App\Http\Requests\ParkingSpace;

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
            'parkingNumber' => 'list:numeric',
            'ownedBy' => 'string',
            'createdByUserId' => 'list:numeric',
        ];
    }
}