<?php

namespace App\Http\Resources;

class ResidentAccessRequestResource extends Resource
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
            'unitId' => $this->unitId,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'type' => $this->type,
            'groups' => $this->groups,
            'status' => $this->status,
            'active' => $this->active,
            'comments' => $this->comments,
            'moderatedUserId' => $this->moderatedUserId,
            'moderatedAt' => $this->moderatedAt,
            'movedinDate' => $this->movedinDate,
            'birthDate' => $this->birthDate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
