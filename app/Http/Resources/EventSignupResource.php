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
            'userId' => $this->userId,
            'residentId' => $this->residentId,
            'guests' => $this->guests,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
