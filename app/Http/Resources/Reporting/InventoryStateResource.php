<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\Resource;
use Illuminate\Http\Request;

class InventoryStateResource extends Resource
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
            'totalInventoryItem' => $this->resource['totalInventoryItem'],
            'inventoryHealthyItem' => $this->resource['inventoryHealthyItem'],
            'inventoryRunningLowItem' => $this->resource['inventoryRunningLowItem'],
        ];
    }
}
