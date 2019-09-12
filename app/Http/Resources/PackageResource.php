<?php

namespace App\Http\Resources;

class PackageResource extends Resource
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
            'unit' => $this->when($this->needToInclude($request, 'package.unit'), function () {
                return new UnitResource($this->unit);
            }),
            'residentId' => $this->residentId,
            'resident' => $this->when($this->needToInclude($request, 'package.resident'), function () {
                return new ResidentResource($this->resident);
            }),
            'typeId' => $this->typeId,
            'type' => $this->when($this->needToInclude($request, 'package.type'), function () {
                return new PackageTypeResource($this->type);
            }),
            'enteredUserId' => $this->enteredUserId,
            'trackingNumber' => $this->trackingNumber,
            'comments' => $this->trackingNumber,
            'notifiedByEmail' => $this->notifiedByEmail,
            'notifiedByText' => $this->notifiedByEmail,
            'notifiedByVoice' => $this->notifiedByVoice,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
