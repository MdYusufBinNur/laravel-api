<?php

namespace App\Http\Requests\Customer;

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
            'createdByUserId' => 'exists:users,id',
            'propertyId' => 'exists:properties,id',
            'name' => 'max:255',
            'email' => 'max:255',
            'phone' => 'max:20',
            'address' => 'max:255',
            'website' => 'max:255',
            'billingInfo' => 'max:255',
            'additionalNote' => 'max:255',
        ];
    }
}
