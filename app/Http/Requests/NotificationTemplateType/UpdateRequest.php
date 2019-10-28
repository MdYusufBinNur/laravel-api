<?php

namespace App\Http\Requests\NotificationTemplateType;

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
            'key' => 'min:5|max:255',
            'module' => 'min:5|max:255',
=======
            'key' => 'max:256',
            'module' => 'max:512',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }
}
