<?php

namespace App\Http\Requests\LdsSlideProperty;

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
            'slideId' => 'exists:lds_slides,id',
        ];
    }
}
