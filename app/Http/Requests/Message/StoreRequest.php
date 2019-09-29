<?php

namespace App\Http\Requests\Message;

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
            'fromUserId' => 'required|exists:users,id',
            'toUserId' => 'required|exists:users,id',
            'subject' => 'required|min:3',
            'isGroupMessage' => 'boolean',
            'group' => 'min:3',
            'groupNames' => 'min:3',
            'emailNotification' => 'boolean',
            'smsNotification' => 'boolean',
            'voiceNotification' => 'boolean',
        ];
    }
}
