<?php

namespace App\Http\Requests\UserNotificationSetting;

use App\DbModels\UserNotificationSetting;
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
            'typeId' => 'required|exists:user_notification_types,id',
            'email' => 'boolean',
            'sms' => 'boolean',
            'voice' => 'boolean',
        ];
    }
}
