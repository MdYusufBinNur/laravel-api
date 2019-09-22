<?php

namespace App\Http\Requests\LdsSetting;

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
            'refreshRate' => 'required|integer',
            'showPackages' => 'boolean',
            'iconSize' => 'required|min:1|max:1024',
            'iconColor' => 'required|min:1|max:100',
            'theme' => 'required|min:3|max:1024',
        ];
    }
}
