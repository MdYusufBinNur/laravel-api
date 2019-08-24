<?php

namespace App\Http\Requests\UserNotificationSetting;

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
            'email' => 'boolean',
            'sms' => 'boolean',
            'voice' => 'boolean',
        ];
    }
}
