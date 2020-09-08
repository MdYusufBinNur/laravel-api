<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\Resource;

class InventoryResource extends Resource
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
            'name' => $this->name,
            'quantity' => $this->quantity,
            'count' => $this->notifyCount,
        ];
    }
}
