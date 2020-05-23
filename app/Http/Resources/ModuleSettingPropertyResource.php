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
            'id' => $this->getIdOrUuid(),
            'createdByUserId' => $this->createdByUserId,
            'cratedByUser' => $this->when($this->needToInclude($request, 'msp.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'propertyId' => $this->propertyId,
            'property' => $this->when($this->needToInclude($request, 'msp.property'), function () {
                return new PropertyResource($this->property);
            }),
            'moduleId' => $this->moduleId,
            'module' => $this->when($this->needToInclude($request, 'msp.module'), function () {
                return new ModuleResource($this->module);
            }),
            'isActive' => $this->isActive,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
