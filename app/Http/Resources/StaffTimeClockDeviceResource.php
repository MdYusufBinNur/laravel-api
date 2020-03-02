<?php

namespace App\Http\Resources;


class StaffTimeClockDeviceResource extends Resource
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
            'managerId' => $this->managerId,
            'timeClockDeviceUserId' => $this->timeClockDeviceUserId,
            'timeClockDeviceId ' => $this->timeClockDeviceId ,
            'timeClockDevice' => $this->when($this->needToInclude($request, 'stcd.timeClockDevice'), function () {
                return new TimeClockDeviceResource($this->timeClockDevice);
            }),
            'created_at ' => $this->created_at ,
            'updated_at ' => $this->updated_at ,
        ];
    }
}
