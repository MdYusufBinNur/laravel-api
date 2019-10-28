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
<<<<<<< HEAD
            'role' => 'required|min:2|max:100',
            'title' => 'required|min:2|max:100',
            'phone' => 'required|min:10|max:20',
=======
            'role' => 'required',
            'title' => 'required',
            'phone' => 'required|max:20',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'displayInCorner' => 'boolean',
            'displayPublicProfile' => 'boolean',
        ];
    }
}
