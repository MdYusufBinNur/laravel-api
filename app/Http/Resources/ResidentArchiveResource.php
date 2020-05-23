<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResidentArchiveResource extends Resource
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
            'createdByUserId' => $this->createdByUserId,
            'propertyId' => $this->propertyId,
            'residentId' => $this->residentId,
            'unitId' => $this->unitId,
            'startAt' => $this->startAt,
            'endAt' => $this->endAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
