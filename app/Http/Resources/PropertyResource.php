<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PropertyResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'company' => $this->company,
            'type' => $this->type,
            'title' => $this->title,
            'subdomain' => $this->subdomain,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'postCode' => $this->postCode,
            'country' => $this->country,
            'language' => $this->language,
            'timezone' => $this->timezone,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
