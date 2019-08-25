<?php

namespace App\Http\Requests\UserNotification;

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
            'notificationIds' => 'required|json|json_ids:user_notifications,id',
            'readStatus' => 'required|boolean'
        ];
    }
}
