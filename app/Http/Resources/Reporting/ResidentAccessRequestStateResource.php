<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\Resource;

class ResidentAccessRequestStateResource extends Resource
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
            'total' => $this->total,
            'pending' => $this->pending,
            'approved' => $this->approved,
            'denied' => $this->denied,
            'completed' => $this->completed,
        ];
    }
}
