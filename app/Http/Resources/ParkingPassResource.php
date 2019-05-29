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
            'propertyId' => $this->propertyId,
            'submittedUserId' => $this->submittedUserId,
            'voidedUserId' => $this->voidedUserId,
            'number' => $this->number,
            'unitId' => $this->unitId,
            'type' => $this->type,
            'status' => $this->status,
            'vehicleMake' => $this->vehicleMake,
            'vehicleModel' => $this->vehicleModel,
            'vehicleLicensePlate' => $this->vehicleLicensePlate,
            'otherDetail' => $this->otherDetail,
            'startAt' => $this->startAt,
            'endAt' => $this->endAt,
            'voidedAt' => $this->voidedAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
