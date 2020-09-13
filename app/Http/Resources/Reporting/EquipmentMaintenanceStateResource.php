<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\Resource;

class EquipmentMaintenanceStateResource extends Resource
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
            'totalEquipment' => $this->total,
            'expired' => $this->expired,
            'expireSoon' => $this->expireSoon,
            'nextToMaintenance' => $this->nextToMaintenance,
        ];
    }
}
