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
<<<<<<< HEAD
            'role' => 'min:2|max:100',
            'title' => 'min:2|max:100',
            'phone' => 'min:10|max:20',
=======
            'role' => '',
            'title' => '',
            'phone' => 'max:20',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'displayInCorner' => 'boolean',
            'displayPublicProfile' => 'boolean',
        ];
    }
}
