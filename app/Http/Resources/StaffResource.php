<?php

namespace App\Http\Resources;

class StaffResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'propertyId' => $this->propertyId,
            'contactEmail' => $this->contactEmail,
            'phone' => $this->phone,
            'title' => $this->title,
            'level' => $this->level,
            'displayInCorner' => $this->displayInCorner,
            'displayPublicProfile' => $this->displayPublicProfile,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new UserResource($this->user)
        ];
    }
}