<?php

namespace App\Http\Requests\PackageArchive;

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
            'signOutUserId' => 'exists:users,id',
<<<<<<< HEAD
            'signOutComment' => 'min:3|max:255',
=======
            'signOutComment' => 'max:512',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'signature' => 'boolean',
            'signOutAt' => 'date',
        ];
    }
}
