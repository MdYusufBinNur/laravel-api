<?php

namespace App\Http\Requests\Vendor;

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
            'createdByUserId' => 'exists:users,id',
            'propertyId' => 'required|exists:properties,id',
            'name' => 'required|max:255',
            'email' => 'max:255',
            'phone' => 'max:20',
            'address' => 'max:255',
            'website' => 'max:255',
            'note' => 'max:255',
        ];
    }
}
