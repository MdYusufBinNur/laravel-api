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
            'text' =>  'required|min:5|max:1024',
            'active' =>  'boolean',
        ];
    }
}
