<?php

namespace App\Http\Requests\Message;

use App\Http\Requests\Request;
use App\Rules\MessageToTower;
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
            'toUserIds' => ['required', new MessageToUser()],
            'towerIds'=> [new MessageToTower($this->request->get('propertyId'), $this->request->get('toUserIds'))],
            'floors' => '', //todo see postman
            'lines' => '', //todo see postman
            'emailNotification' => 'boolean',
            'smsNotification' => 'boolean',
            'voiceNotification' => 'boolean',
        ];
    }
}
