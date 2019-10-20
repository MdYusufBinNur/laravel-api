<?php

namespace App\Http\Resources;

class FloorListAutoCompleteResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'unitId' => $this->resource['id'],
            'towerId' => $this->resource['towerId'],
            'line' => $this->resource['line'],
            'floor' => $this->resource['floor'],
        ];
    }
}
