<?php

namespace App\Http\Resources;

class EventResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'createdByUserId' => $this->createdByUserId,
            'propertyId' => $this->propertyId,
            'property' => $this->when($this->needToInclude($request, 'event.property'), function () {
                return new PropertyResource($this->property);
            }),
            'title' => $this->title,
            'text' => $this->text,
            'maxGuests' => $this->maxGuests,
            'allowedSignUp' => $this->allowedSignUp,
            'allDayEvent' => $this->allDayEvent,
            'allowedLoginPage' => $this->allowedLoginPage,
            'hasAttachment' => $this->hasAttachment,
            'attachments' => $this->when($this->needToInclude($request, 'event.attachments'), function () {
                return new AttachmentResourceCollection($this->attachments);
            }),
            'startAt' => $this->startAt,
            'endAt' => $this->endAt,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
