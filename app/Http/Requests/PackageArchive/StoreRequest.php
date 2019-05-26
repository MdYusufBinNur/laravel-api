<?php

namespace App\Http\Requests\PackageArchive;

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
            'packageId' => 'required|exists:packages,id',
            'signoutUserId' => 'required|exists:users,id',
            'signoutComments' => 'min:3|max:512',
            'signature' => 'boolean',
            'signoutAt' => 'required|date',
        ];
    }
}
