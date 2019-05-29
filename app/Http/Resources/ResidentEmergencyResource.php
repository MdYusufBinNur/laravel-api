<?php

namespace App\Http\Resources;

class ResidentEmergencyResource extends Resource
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
            'residentId' => $this->residentId,
            'name' => $this->name,
            'relationship' => $this->relationship,
            'address' => $this->address,
            'homePhone' => $this->homePhone,
            'cellPhone' => $this->cellPhone,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
