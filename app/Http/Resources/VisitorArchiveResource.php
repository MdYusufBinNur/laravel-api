<?php

namespace App\Http\Resources;

class VisitorArchiveResource extends Resource
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
            'property' => $this->when($this->needToInclude($request, 'va.property'), function () {
                return new PropertyResource($this->property);
            }),
            'visitorId' => $this->visitorId,
            'visitor' => $this->when($this->needToInclude($request, 'va.visitor'), function () {
                return new VisitorResource($this->visitor);
            }),
            'signOutUserId' => $this->signOutUserId,
            'signature' => $this->signature,
            'signOutAt' => $this->signOutAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
