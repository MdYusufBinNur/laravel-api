<?php

namespace App\Http\Requests\UserNotificationType;

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
            'type' => 'min:3|max:512',
            'description' => 'min:10|max:1012'
        ];
    }
}