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
            'id' =>$this->id,
            'propertyId' =>$this->propertyId,
            'unitId' =>$this->unitId,
        ];
    }
}
