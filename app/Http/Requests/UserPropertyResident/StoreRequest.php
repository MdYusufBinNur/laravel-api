<?php

namespace App\Http\Requests\UserPropertyResident;

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
            'userId' => 'required|exists:users,id',
            'propertyId' => 'required|exists:properties,id',
            'unitId' => 'required|exists:units,id',
<<<<<<< HEAD
            'role' => 'required|min:2|max:100',
            'groups' => 'required|min:2|max:100',
=======
            'role' => 'required',
            'groups' => 'required',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'displayUnit' => 'boolean',
            'displayPublicProfile' => 'boolean',
            'allowPostNote' => 'boolean',
        ];
    }
}
