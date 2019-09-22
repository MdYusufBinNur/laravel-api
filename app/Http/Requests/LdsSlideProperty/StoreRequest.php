<?php

namespace App\Http\Requests\LdsSlideProperty;

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
            'slideId' => 'required|exists:lds_slides,id',
        ];
    }
}
