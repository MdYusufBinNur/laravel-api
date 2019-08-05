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
            'type' => 'in:'.UserNotificationSetting::TYPE_DAILY_DIGEST['id'].','.UserNotificationSetting::TYPE_LEAVE_NOTE['id'].','.UserNotificationSetting::TYPE_DELIVERY_PICKUP['id'].','.UserNotificationSetting::TYPE_SERVICE_REQUEST['id'].','.UserNotificationSetting::TYPE_RETURN_MY_KEY['id'],
            'email' => 'boolean',
            'sms' => 'boolean',
            'voice' => 'boolean',
        ];
    }
}
