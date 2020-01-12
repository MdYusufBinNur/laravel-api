<?php

namespace App\Http\Resources;

class StaffTimeClockResource extends Resource
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
            'managerId' => $this->managerId,
            'propertyId' => $this->propertyId,
            'clockedIn' => $this->clockedIn,
            'clockedOut' => $this->clockedOut,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
