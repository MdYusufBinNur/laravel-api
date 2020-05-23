<?php

namespace App\Http\Resources;

class LdsBlacklistUnitResource extends Resource
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
            'propertyId' =>$this->propertyId,
            'property' => $this->when($this->needToInclude($request, 'lbu.property'), function () {
                return new PropertyResource($this->property);
            }),
            'unitId' =>$this->unitId,
            'unit' => $this->when($this->needToInclude($request, 'lbu.unit'), function () {
                return new UnitResource($this->unit);
            }),
        ];
    }
}
