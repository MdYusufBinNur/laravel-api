<?php

namespace App\Http\Resources;

class EventSignupResource extends Resource
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
            'eventId' => $this->eventId,
            'event' => $this->when($this->needToInclude($request, 'es.event'), function () {
                return new EventResource($this->event);
            }),
            'userId' => $this->userId,
            'user' => $this->when($this->needToInclude($request, 'es.user'), function () {
                return new UserResource($this->user);
            }),
            'residentId' => $this->residentId,
            'resident' => $this->when($this->needToInclude($request, 'es.resident'), function () {
                return new ResidentResource($this->resident);
            }),
            'guests' => $this->guests,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
