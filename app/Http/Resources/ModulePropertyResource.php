<?php

namespace App\Http\Resources;

class ModulePropertyResource extends Resource
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
            'moduleId' => $this->moduleId,
            'module' => $this->when($this->needToInclude($request, 'mp.module'), function () {
                return new ModuleResource($this->module);
            }),
            'value' => $this->value,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
