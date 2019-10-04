<?php

namespace App\Http\Requests\Message;

use App\Http\Requests\Request;
use App\Rules\MessageToUser;

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
            'subject' => 'required|min:3',
            'text' => 'required|string',
            'toUserIds' => ['required', new MessageToUser()], // todo rule either userId or Message group constant
            'towerIds'=> 'json|json_ids:towers,id', //todo rule
            'floors' => '', //todo see postman
            'lines' => '', //todo see postman
            'emailNotification' => 'boolean',
            'smsNotification' => 'boolean',
            'voiceNotification' => 'boolean',
        ];
    }
}
