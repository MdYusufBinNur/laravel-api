<?php
namespace App\Http\Requests\Package;


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
            'propertyId' => 'required|exists:properties,id',
            'unitId' => 'required|exists:units,id',
            'residentId' => 'required|exists:residents,id',
            'typeId' => 'required|exists:package_types,id',
            'enteredUserId' => 'required|exists:users,id',
            'trackingNumber' => 'min:3|max:191',
            'comments' => 'min:3|max:1024',
            'notifiedByEmail' => 'boolean',
            'notifiedByText' => 'boolean',
            'notifiedByVoice' => 'boolean',
        ];
    }
}
