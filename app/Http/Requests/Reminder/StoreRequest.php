<?php

namespace App\Http\Requests\Reminder;

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
            'propertyId' => 'exists:properties,id',
            'toUserIds' => 'sting',
            'toUnitIds' => 'string',
            'reminderType' => 'in:',
            'resourceType' => 'in:',
            'resourceId' => 'numeric',
        ];
    }
}
