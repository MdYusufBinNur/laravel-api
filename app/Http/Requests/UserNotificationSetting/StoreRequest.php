<?php

namespace App\Http\Requests\UserNotificationSetting;

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
            'type' => 'min:3|max:191',
            'email' => 'boolean',
            'sms' => 'boolean',
            'voice' => 'boolean',
        ];
    }
}
