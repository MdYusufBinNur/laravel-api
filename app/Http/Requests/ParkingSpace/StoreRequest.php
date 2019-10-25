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
            'parkingNumber' => 'required',
            'ownerUserId' => 'required_without:ownedBy|exists:users,id',
            'ownedBy' => 'required_without:ownerUserId',
            'address' => 'required_without:ownerUserId',
            'email' => 'required_without:ownerUserId|email',
            'phone' => 'required_without:ownerUserId',
        ];
    }
}
