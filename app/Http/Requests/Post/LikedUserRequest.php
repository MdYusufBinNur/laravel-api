<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\Request;

class LikedUserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'postId' => 'required|numeric',
            'propertyId' => 'required|numeric',
        ];
    }
}
