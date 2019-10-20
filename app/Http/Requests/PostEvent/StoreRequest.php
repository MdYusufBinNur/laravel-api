<?php

namespace App\Http\Requests\PostEvent;

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
            'eventId' => 'required_without:event|exists:events,id',

            'post' => '',
            'post.propertyId' => 'required_with:post|exists:properties,id',
            'post.attachmentIds' => 'json|json_ids:attachments,id',

            'event' => 'required_without:eventId',
            'event.propertyId' => 'required_with:event|exists:properties,id',
            'event.title' => 'required_with:event|min:5|max:191',
            'event.text' => 'min:5|max:512',
            'event.maxGuests' => 'required_with:event|numeric',
            'event.allowedSignUp' => 'boolean',
            'event.allDayEvent' => 'boolean',
            'event.allowedLoginPage' => 'boolean',
            'event.hasAttachment' => 'boolean',
            // todo startAt & endAt is not required when eventId is present
            'event.startAt' => 'date_format:"H:i"|required_unless:event.allDayEvent,1',
            'event.endAt' => 'date_format:"H:i"|required_unless:event.allDayEvent,1|after:event.startAt',
            'event.date' => 'required_with:event|date|after_or_equal:now',

        ];
    }
}
