<?php

namespace App\Http\Requests\FdiGuestType;

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
            'title' => 'required|min:3|max:255',
=======
            'title' => 'required|max:100',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'propertyId' => 'required|exists:properties,id',
        ];
    }
}
