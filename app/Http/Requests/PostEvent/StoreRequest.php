<?php

namespace App\Http\Requests\PostEvent;

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
            'eventId' => 'required_without:event|exists:events,id',

            'post' => '',
            'post.propertyId' => 'required_with:post|exists:properties,id',
            'post.attachmentIds' => [new ListOfIds('attachments', 'id')],

            'event' => 'required_without:eventId',
            'event.propertyId' => 'required_with:event|exists:properties,id',
            'event.title' => 'required_with:event|max:255',
            'event.text' => 'max:16777215',
            'event.location' => 'max:255',
            'event.maxGuests' => 'required_with:event|numeric',
            'event.allowedSignUp' => 'boolean',
            'event.multipleDaysEvent' => 'boolean',
            'event.allowedLoginPage' => 'boolean',
            'event.hasAttachment' => 'boolean',
            'event.startAt' => 'date_format:"H:i"',
            'event.endAt' => 'date_format:"H:i"|after:event.startAt',
            'event.date' => 'required_with:event|date|after_or_equal:now',
            'event.endDate' => 'required_with:event|date|after_or_equal:event.date',

        ];
    }
}
