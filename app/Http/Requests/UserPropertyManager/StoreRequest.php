<?php

namespace App\Http\Requests\UserPropertyManager;

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
            'userId' => 'required|exists:users,id',
            'propertyId' => 'required|exists:properties,id',
            'role' => 'required|min:2',
            'title' => 'required|min:2',
            'phone' => 'required|min:10|max:20',
            'displayInCorner' => 'boolean',
            'displayPublicProfile' => 'boolean',
        ];
    }
}
