<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ModulePropertyResource extends JsonResource
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
            'id'                    => $this->id,
            'createdByUserId'       => $this->createdByUserId,
            'propertyId'            => $this->propertyId,
            'moduleId'              => $this->moduleId,
            'value'                 => $this->value,
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at
        ];
    }
}
