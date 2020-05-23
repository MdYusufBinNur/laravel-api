<?php

namespace App\Http\Resources;


class TimeClockDeviceResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->getIdOrUuid(),
            'createdByUserId' => $this->createdByUserId,
            'propertyId' => $this->propertyId,
            'deviceSN' => $this->deviceSN,
            'location' => $this->location,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
