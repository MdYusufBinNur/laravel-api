<?php

namespace App\Http\Requests\ServiceRequestMessage;

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
            'text' => 'min:10|max:65535',
=======
            'text' => 'max:2048',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'readStatus' => 'boolean',
        ];
    }
}
