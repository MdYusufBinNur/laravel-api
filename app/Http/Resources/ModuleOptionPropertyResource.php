<?php

namespace App\Http\Resources;

class ModuleOptionPropertyResource extends Resource
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
            'value' => $this->value,
            'moduleOptionId' => $this->moduleOptionId,
            'moduleOption' => $this->when($this->needToInclude($request, 'mop.moduleOption'), function () {
                return new ModuleOptionResource($this->moduleOption);
            }),
            'updated_at' => $this->updated_at,

        ];
    }
}
