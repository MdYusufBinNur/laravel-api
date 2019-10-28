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
<<<<<<< HEAD
            'signOutComment' => 'min:3|max:255',
=======
            'signOutComment' => 'max:512',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'signature' => 'boolean'
        ];
    }
}
