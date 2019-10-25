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
            'text' =>  'max:1024',
            'active' =>  'boolean',
        ];
    }
}
