<?php

namespace App\Http\Requests\PaymentType;

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
            'title' => 'min:2|max:255',
            'propertyId' => 'exists:properties,id',
        ];
    }
}
