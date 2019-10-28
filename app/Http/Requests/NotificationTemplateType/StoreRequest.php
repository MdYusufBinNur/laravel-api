<?php

namespace App\Http\Requests\NotificationTemplateType;

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
<<<<<<< HEAD
            'key' => 'required|min:5|max:255',
            'module' => 'required|min:5|max:255',
=======
            'key' => 'required|max:256',
            'module' => 'required|max:512',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }
}
