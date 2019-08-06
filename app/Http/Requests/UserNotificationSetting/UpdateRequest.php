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
            'userNotificationSettings' => '',
            'userNotificationSettings.*.userId' => 'exists:users,id',
            'userNotificationSettings.*.typeId' => 'exists:user_notification_types,id',
            'userNotificationSettings.*.email' => 'boolean',
            'userNotificationSettings.*.sms' => 'boolean',
            'userNotificationSettings.*.voice' => 'boolean',
        ];
    }
}
