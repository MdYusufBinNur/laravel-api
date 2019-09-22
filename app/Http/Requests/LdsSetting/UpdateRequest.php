<?php

namespace App\Http\Requests\LdsSetting;

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
            'refreshRate' => 'integer',
            'showPackages' => 'boolean',
            'iconSize' => 'min:1|max:1024',
            'iconColor' => 'min:1|max:100',
            'theme' => 'min:3|max:1024',
        ];
    }
}
