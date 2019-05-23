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
            'createdUserId' => $this->createdUserId,
            'title' => $this->title,
            'text' => $this->text,
            'maxGuests' => $this->maxGuests,
            'allowedSignUp' => $this->allowedSignUp,
            'alldayEvent' => $this->alldayEvent,
            'allowedLoginPage' => $this->allowedLoginPage,
            'hasAttachment' => $this->hasAttachment,
            'startAt' => $this->startAt,
            'endAt' => $this->endAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
