<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\Resource;

class VisitorDaysWiseResource extends Resource
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
            'date' => $this->signInAt,
            'visitors' => $this->visitors
        ];
    }
}
