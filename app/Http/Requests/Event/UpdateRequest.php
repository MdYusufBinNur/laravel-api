<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\Request;
use App\Rules\ListOfIds;

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
            'title' => 'max:255',
            'text' => 'max:16777215',
            'location' => 'max:255',
            'maxGuests' => 'numeric',
            'allowedSignUp' => 'boolean',
            'multipleDaysEvent' => 'boolean',
            'allowedLoginPage' => 'boolean',
            'hasAttachment' => 'boolean',
            'startAt' => 'date_format:"H:i"',
            'endAt' => 'date_format:"H:i"|after:startAt',
            'date' => 'date|after_or_equal:today',
            'endDate' => 'date|after_or_equal:date',
            'attachmentIds' => [new ListOfIds('attachments', 'id')]
        ];
    }
}
