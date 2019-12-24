<?php

namespace App\Http\Requests\PaymentMethod;

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
            'title' => 'required|min:2|max:255',
            'propertyId' => 'exists:properties,id',
        ];
    }
}
