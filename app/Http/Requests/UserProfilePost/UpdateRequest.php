<?php

namespace App\Http\Requests\UserProfilePost;

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
            'propertyId' =>  'exists:properties,id',
            'byUserId' => 'exists:users,id',
            'toUserId' => 'exists:users,id',
<<<<<<< HEAD
            'text' =>  'min:5|max:16777215',
=======
            'text' =>  'max:1024',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'active' =>  'boolean',
        ];
    }
}
