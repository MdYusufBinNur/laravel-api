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
            'url' => 'min:10|max:191',
        ];
    }
}
