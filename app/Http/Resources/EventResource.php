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
            'createdByUser' =>  $this->when($this->needToInclude($request, 'event.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'propertyId' => $this->propertyId,
            'property' => $this->when($this->needToInclude($request, 'event.property'), function () {
                return new PropertyResource($this->property);
            }),
            'title' => $this->title,
            'text' => $this->text,
            'location' => $this->location,
            'maxGuests' => $this->maxGuests,
            'allowedSignUp' => $this->allowedSignUp,
            'multipleDaysEvent' => $this->multipleDaysEvent,
            'allowedLoginPage' => $this->allowedLoginPage,
            'hasAttachment' => $this->hasAttachment,
            'signups' => $this->when($this->needToInclude($request, 'event.signups'), function () {
                return new EventSignupResourceCollection($this->eventSignups);
            }),
            'attachments' => $this->when($this->needToInclude($request, 'event.attachments'), function () {
                return new AttachmentResourceCollection($this->attachments);
            }),
            'startAt' => $this->startAt,
            'endAt' => $this->endAt,
            'date' => $this->date,
            'endDate' => $this->endDate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
