<?php

namespace App\Http\Requests\PackageType;

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
            'title' => 'min:3|max:191',
            'icon' => 'integer',
        ];
    }
}
