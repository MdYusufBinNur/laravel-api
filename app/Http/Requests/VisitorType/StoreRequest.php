<?php

namespace App\Http\Requests\VisitorType;

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
            'title' => 'required|min:3|max:255|unique_with:visitor_types,propertyId',
            'propertyId' => 'required|exists:properties,id'
        ];
    }
}
