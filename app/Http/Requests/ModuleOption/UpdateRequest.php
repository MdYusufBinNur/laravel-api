<?php

namespace App\Http\Requests\ModuleOption;

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
            'moduleId'      => 'numeric|exists:modules,id',
<<<<<<< HEAD
            'key'           => 'min:5|max:255',
            'title'         => 'min:5|max:255',
=======
            'key'           => 'max:191',
            'title'         => 'max:191',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }
}
