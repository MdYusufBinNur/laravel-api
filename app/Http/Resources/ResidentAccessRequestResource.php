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
            'unit' => $this->when($this->needToInclude($request, 'residentAccessRequest.unit'), function () {
                return new UnitResource($this->unit);
            }),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'type' => $this->type,
            'groups' => $this->groups,
            'status' => $this->status,
            'active' => $this->active,
            'comment' => $this->comment,
            'pin' => $this->when($this->needToInclude($request, 'residentAccessRequest.pin'), function () {
                return $this->pin;
            }),
            'moderatedUserId' => $this->moderatedUserId,
            'moderatedAt' => $this->moderatedAt,
            'movedInDate' => $this->movedInDate,
            'birthDate' => $this->birthDate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
