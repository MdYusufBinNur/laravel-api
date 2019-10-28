<?php

namespace App\Http\Requests\PackageType;

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
            'title' => 'required|min:3|max:255',
            'icon' => 'required|integer',
        ];
    }
}
