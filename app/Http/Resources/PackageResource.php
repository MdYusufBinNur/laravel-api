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
            'unitId' => $this->unitId,
            'residentId' => $this->residentId,
            'typeId' => $this->typeId,
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
