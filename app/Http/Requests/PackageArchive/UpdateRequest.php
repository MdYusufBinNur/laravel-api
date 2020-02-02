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
            'signOutComment' => 'max:255',
            'signature' => 'boolean',
            'signOutAt' => '',
        ];
    }
}
