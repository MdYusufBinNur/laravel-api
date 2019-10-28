<?php

namespace App\Http\Requests\PackageType;

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
            'title' => 'min:3|max:255',
=======
            'title' => 'max:191',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'icon' => 'integer',
        ];
    }
}
