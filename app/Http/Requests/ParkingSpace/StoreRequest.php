<?php

namespace App\Http\Requests\ParkingSpace;

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
            'parkingNumber' => 'required|min:1',
            'ownedBy' => 'min:2',
        ];
    }
}
