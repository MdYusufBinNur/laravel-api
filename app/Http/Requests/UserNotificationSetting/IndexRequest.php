<?php

namespace App\Http\Requests\UserNotificationSetting;

use App\Http\Requests\Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'list:numeric',
            'userId' => 'list:numeric',
            'typeId' => 'list:numeric',
            'email' => 'list:boolean',
            'sms' => 'list:boolean',
            'voice' => 'list:boolean',
        ];
    }
}
