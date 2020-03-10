<?php

namespace App\Http\Resources;


class CommitteeSessionResource extends Resource
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
            'id' => $this->id,
            'propertyId' => $this->propertyId,
            'property' => $this->when($this->needToInclude($request, 'cs.property'), function () {
                return new PropertyResource($this->property);
            }),
            'committeeTypeId' => $this->committeeTypeId,
            'committeeType' => $this->when($this->needToInclude($request, 'cs.committeeType'), function () {
                return new CommitteeTypeResource($this->committeeType);
            }),
            'sessionName' => $this->sessionName,
            'startedDate' => $this->startedDate,
            'endedDate' => $this->endedDate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
