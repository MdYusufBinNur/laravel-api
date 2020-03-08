<?php

namespace App\Http\Resources;


class PropertyCommitteeResource extends Resource
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
            'committeeTypeId' => $this->committeeTypeId,
            'committeeSessionId' => $this->committeeSessionId,
            'committeeRankId' => $this->committeeRankId,
            'userId' => $this->userId,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
