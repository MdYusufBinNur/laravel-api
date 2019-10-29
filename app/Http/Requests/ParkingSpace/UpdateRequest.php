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
            'parkingNumber' => 'required|unique_with:parking_spaces,propertyId',
            'ownerUserId' => 'required_without:ownedBy|exists:users,id',
            'ownedBy' => 'required_without:ownerUserId|max:255',
            'address' => 'required_without:ownerUserId|max:255',
            'email' => 'required_without:ownerUserId|email|max:255',
            'phone' => 'required_without:ownerUserId|max:20',
        ];
    }
}
