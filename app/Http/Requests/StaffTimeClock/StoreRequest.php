<?php

namespace App\Http\Requests\StaffTimeClock;

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
            'managerId' => 'required|exists:managers,id',
            'propertyId' => 'required|exists:properties,id',
            'clockInNote' => 'max:65535',
            'attachmentId' => 'required|exists:attachments,id'
        ];
    }
}
