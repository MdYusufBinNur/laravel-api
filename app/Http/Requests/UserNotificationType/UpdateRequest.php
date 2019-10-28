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
<<<<<<< HEAD
            'type' => 'min:3|max:255',
            'description' => 'min:10|max:255'
=======
            'type' => 'max:512',
            'description' => 'max:1012'
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }
}
