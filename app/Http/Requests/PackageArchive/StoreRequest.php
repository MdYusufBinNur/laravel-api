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
            'packageId' => 'required|unique:package_archives,packageId|exists:packages,id',
            'propertyId' => 'required|exists:properties,id',
            'signOutUserId' => 'required|exists:users,id',
            'signOutComment' => 'max:255',
            'signature' => 'boolean'
        ];
    }
}
