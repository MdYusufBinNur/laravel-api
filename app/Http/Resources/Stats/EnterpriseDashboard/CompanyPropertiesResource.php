<?php

namespace App\Http\Resources\Stats\EnterpriseDashboard;


use App\Http\Resources\Resource;

class CompanyPropertiesResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'totalActiveUsers' => $this->resource['totalActiveUsers'],
            'totalStaffs' => $this->resource['totalStaffs'],
            'totalEnterpriseUsers' => $this->resource['totalEnterpriseUsers'],
            'totalTowers' => $this->resource['totalTowers'],
            'totalUnits' => $this->resource['totalUnits'],
        ];
    }
}
