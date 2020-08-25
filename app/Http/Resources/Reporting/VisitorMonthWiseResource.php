<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\Resource;

class VisitorMonthWiseResource extends Resource
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
            'month' => $this->month,
            'visitors' => $this->visitors
        ];
    }
}
