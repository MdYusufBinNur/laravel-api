<?php

namespace App\Http\Requests\PropertySocialMedia;

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
            'propertyId' => 'exists:properties,id',
            'type' => 'min:3|max:191',
            'url' => 'min:3|max:191',
        ];
    }
}
