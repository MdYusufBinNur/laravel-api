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
            'signOutComment' => 'min:3|max:512',
            'signature' => 'boolean',
            'signOutAt' => 'date',
        ];
    }
}
