<?php

namespace App\Http\Requests\MessageTemplate;

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
            'propertyId' => 'required|exists:properties,id',
<<<<<<< HEAD
            'title' => 'required|min:3|max:255',
            'text' => 'required|min:3|max:16777215',
=======
            'title' => 'required|max:512',
            'text' => 'required|max:2048',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }
}
