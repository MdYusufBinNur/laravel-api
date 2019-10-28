<?php

namespace App\Http\Requests\UserProfilePost;

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
            'propertyId' =>  'required|exists:properties,id',
            'byUserId' => 'required|exists:users,id',
            'toUserId' => 'required|exists:users,id',
<<<<<<< HEAD
            'text' =>  'required|min:5|max:16777215',
=======
            'text' =>  'required|max:1024',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'active' =>  'boolean',
        ];
    }
}
