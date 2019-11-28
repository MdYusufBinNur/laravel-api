<?php

namespace App\Http\Resources;


class ModuleSettingPropertyResource extends Resource
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
            'property' => $this->when($this->needToInclude($request, 'msp.property'), function () {
                return new PropertyResource($this->property);
            }),
            'modulePropertyId' => $this->modulePropertyId,
            'moduleProperty' => $this->when($this->needToInclude($request, 'msp.moduleProperty'), function () {
                return new ModulePropertyResource($this->moduleProperty);
            }),
            'isActive' => $this->isActive,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
