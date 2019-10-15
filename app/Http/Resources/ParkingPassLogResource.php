<?php

namespace App\Http\Resources;


class ParkingPassLogResource extends Resource
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
            'spaceId' => $this->spaceId,
            'make' => $this->make,
            'model' => $this->model,
            'licensePlate' => $this->licensePlate,
            'startAt' => $this->startAt,
            'endAt' => $this->endAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}