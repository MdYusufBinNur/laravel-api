<?php

namespace App\Http\Requests\UserNotificationType;

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
            'type' => 'required|max:512',
            'description' => 'max:1012'
        ];
    }
}
