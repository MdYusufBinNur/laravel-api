<?php

namespace App\Http\Requests\PropertyImage;

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
            'propertyId' =>  'required|exists:properties,id',
            'title' =>  'min:3|max:191',
            'imageId' =>  'required|exists:attachments,id',
        ];
    }
}
