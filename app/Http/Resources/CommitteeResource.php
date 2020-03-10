<?php

namespace App\Http\Resources;


class CommitteeResource extends Resource
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
            'committeeHierarchyId' => $this->committeeHierarchyId,
            'userId' => $this->userId,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
