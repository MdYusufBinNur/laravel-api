<?php

namespace App\Http\Requests\Package;

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
            'unitId' => 'exists:units,id',
            'residentId' => 'exists:residents,id',
            'typeId' => 'exists:package_types,id',
            'enteredUserId' => 'exists:users,id',
            'trackingNumber' => 'min:3|max:191',
            'comments' => 'min:3|max:1024',
            'notifiedByEmail' => 'boolean',
            'notifiedByText' => 'boolean',
            'notifiedByVoice' => 'boolean',
        ];
    }
}
