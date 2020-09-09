<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\Resource;
use Illuminate\Http\Request;

class ParkingManagementStateResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'totalSpace' => $this->resource['totalSpace'],
            'inUseSpace' => $this->resource['inUseSpace'],
            'todayTotalIn' => $this->resource['todayTotalIn'],
            'todayTotalOut' => $this->resource['todayTotalOut'],
        ];
    }
}
