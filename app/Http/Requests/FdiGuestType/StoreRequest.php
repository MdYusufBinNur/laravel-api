<?php

namespace App\Http\Requests\FdiGuestType;

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
            'title' => 'required|max:100',
            'propertyId' => 'required|exists:properties,id',
        ];
    }
}
