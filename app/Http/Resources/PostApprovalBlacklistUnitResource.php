<?php

namespace App\Http\Resources;

class PostApprovalBlacklistUnitResource extends Resource
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
            'createdByUserId' =>  $this->createdByUserId,
            'unitId' =>  $this->unitId,
            'unit' => $this->when($this->needToInclude($request, 'pabu.unit'), function () {
                return new UnitResource($this->unit);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
