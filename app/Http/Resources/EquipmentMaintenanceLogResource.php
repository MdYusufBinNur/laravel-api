<?php

namespace App\Http\Resources;


class EquipmentMaintenanceLogResource extends Resource
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
            'createdByUser' => $this->when($this->needToInclude($request, 'eml.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'propertyId' => $this->propertyId,
            'equipmentId' => $this->equipmentId,
            'equipment' => $this->when($this->needToInclude($request, 'eml.equipment'), function () {
                return new EquipmentResource($this->equipment);
            }),
            'note' => $this->note,
            'nextMaintenanceDate' => $this->nextMaintenanceDate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
