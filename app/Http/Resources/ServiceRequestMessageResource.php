<?php

namespace App\Http\Resources;

class ServiceRequestMessageResource extends Resource
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
            'propertyId' => $this->propertyId,
            'serviceRequestId' => $this->serviceRequestId,
            'userId' => $this->userId,
            'unitId' => $this->unitId,
            'text' => $this->text,
            'type' => $this->type,
            'readStatus' => $this->readStatus,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => $this->when($this->needToInclude($request, 'srm.user'), function () {
                return new UserResource($this->user);
            }),
        ];
    }
}
