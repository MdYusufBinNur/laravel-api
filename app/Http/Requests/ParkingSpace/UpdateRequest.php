<?php

namespace App\Http\Requests\ParkingSpace;

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
            'parkingNumber' => 'min:1',
            'ownedBy' => 'min:2',
        ];
    }
}
