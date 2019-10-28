<?php

namespace App\Http\Requests\UserPropertyResident;

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
            'userId' => 'exists:users,id',
            'propertyId' => 'exists:properties,id',
            'unitId' => 'exists:units,id',
<<<<<<< HEAD
            'role' => 'min:2|max:100',
            'groups' => 'min:2|max:100',
=======
            'role' => '',
            'groups' => '',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'displayUnit' => 'boolean',
            'displayPublicProfile' => 'boolean',
            'allowPostNote' => 'boolean',
        ];
    }
}
