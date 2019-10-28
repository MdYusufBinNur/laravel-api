<?php

namespace App\Http\Requests\UserPropertyManager;

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
            'userId' => 'exists:users,id',
            'propertyId' => 'exists:properties,id',
            'role' => 'min:2|max:100',
            'title' => 'min:2|max:100',
            'phone' => 'min:10|max:20',
            'displayInCorner' => 'boolean',
            'displayPublicProfile' => 'boolean',
        ];
    }
}
