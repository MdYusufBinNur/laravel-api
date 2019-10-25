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
            'role' => '',
            'groups' => '',
            'displayUnit' => 'boolean',
            'displayPublicProfile' => 'boolean',
            'allowPostNote' => 'boolean',
        ];
    }
}
