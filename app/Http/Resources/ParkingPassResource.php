<?php

namespace App\Http\Resources;


class ParkingPassResource extends Resource
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
            'createdByUser' =>  $this->when($this->needToInclude($request, 'pp.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'propertyId' => $this->propertyId,
            'unitId' => $this->unitId,
            'unit' =>  $this->when($this->needToInclude($request, 'pp.unit'), function () {
                return new UnitResource($this->unit);
            }),
            'spaceId' => $this->spaceId,
            'space' =>  $this->when($this->needToInclude($request, 'pp.space'), function () {
                return new ParkingSpaceResource($this->parkingSpace);
            }),
            'make' => $this->make,
            'model' => $this->model,
            'licensePlate' => $this->licensePlate,
            'startAt' => $this->startAt,
            'endAt' => $this->endAt,
            'releasedAt' => $this->releasedAt,
            'releasedByUserId' => $this->releasedByUserId,
            'releasedByUser' =>  $this->when($this->needToInclude($request, 'pp.releasedByUser'), function () {
                return new UserResource($this->releasedByUser);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
