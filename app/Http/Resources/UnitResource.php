<?php

namespace App\Http\Resources;

class UnitResource extends Resource
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
            'towerId' => $this->towerId,
            'propertyId' => $this->propertyId,
            'floor' => $this->floor,
            'title' => $this->title,
            'line' => $this->line,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
