<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\Resource;
use Illuminate\Http\Request;

class ParkingManagementResource extends Resource
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
            'spaceName' => $this->spaceName,
            'in' => $this->in,
            'out' => $this->out,
        ];
    }
}
