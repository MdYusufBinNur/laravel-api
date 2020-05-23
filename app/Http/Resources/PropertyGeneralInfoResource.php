<?php

namespace App\Http\Resources;


class PropertyGeneralInfoResource extends Resource
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
            'id' => $this->getIdOrUuid(),
            'propertyId' => $this->propertyId,
            'officeHours' => $this->officeHours,
            'phone' => $this->phone,
            'emergenceContact' => $this->emergenceContact,
            'email' => $this->email,
            'additionalInfo' => $this->additionalInfo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
