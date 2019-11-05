<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\Request;
use App\Rules\ListOfIds;

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
            'title' => 'required|max:255',
            'text' => 'max:16777215',
            'location' => 'required|max:255',
            'maxGuests' => 'required|numeric',
            'allowedSignUp' => 'boolean',
            'multipleDaysEvent' => 'boolean',
            'allowedLoginPage' => 'boolean',
            'hasAttachment' => 'boolean',
            'startAt' => 'date_format:"H:i"',
            'endAt' => 'date_format:"H:i"|after:startAt',
            'date' => 'required|date|after_or_equal:today',
            'endDate' => 'required|date|after_or_equal:date',
            'attachmentIds' => [new ListOfIds('attachments', 'id')],
        ];
    }
}
