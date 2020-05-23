<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResidentVehicleResource extends Resource
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
            'residentId' => $this->residentId,
            'make' => $this->make,
            'model' => $this->model,
            'color' => $this->color,
            'licensePlate' => $this->licensePlate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
