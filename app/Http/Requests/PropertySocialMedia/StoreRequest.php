<?php

namespace App\Http\Requests\PropertySocialMedia;

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
            'type' => 'required|min:3|max:191',
            'url' => 'required|min:3|max:191',
        ];
    }
}
