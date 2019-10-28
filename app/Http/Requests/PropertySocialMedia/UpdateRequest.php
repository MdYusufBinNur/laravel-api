<?php

namespace App\Http\Requests\PropertySocialMedia;

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
            'url' => 'min:10|max:255',
=======
            'url' => 'max:191',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }
}
