<?php

namespace App\Http\Requests\PropertyImage;

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
            'title' =>  'max:191',
            'imageId' =>  'exists:attachments,id',
        ];
    }
}
