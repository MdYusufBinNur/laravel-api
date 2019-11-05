<?php

namespace App\Http\Resources;


class EquipmentResource extends Resource
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
            'name' => $this->name,
            'sku'  => $this->sku,
            'propertyId'  => $this->propertyId,
            'description'  => $this->description,
            'location' => $this->location,
            'areaServices' => $this->areaServices,
            'manufacturer' => $this->manufacturer,
            'expireDate' => $this->expireDate,
            'modelNumber' => $this->modelNumber ,
            'requiredService' => $this->requiredServices,
            'nextMaintenanceDate' => $this->nextMaintenanceDate,
            'notifyDuration' => $this->notifyDuration,
            'restockNote'  => $this->restockNote,
        ];
    }
}
