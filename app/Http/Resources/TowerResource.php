<?php

namespace App\Http\Resources;

class TowerResource extends Resource
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
            'title' => $this->title,
            'createdByUserId' => $this->createdByUserId,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
