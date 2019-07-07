<?php

namespace App\Http\Resources;

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
            'company' => $this->companyId,
            'type' => $this->type,
            'title' => $this->title,
            'domain' => $this->domain,
            'subdomain' => $this->subdomain,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'postCode' => $this->postCode,
            'country' => $this->country,
            'language' => $this->language,
            'timezone' => $this->timezone,
            'active' => $this->active,

            $this->mergeWhen($this->needToInclude($request, 'noOfUsers'), [
                'noOfUsers' => $this->users->count(),
            ]),
            $this->mergeWhen($this->needToInclude($request, 'noOfUnits'), [
                'noOfUnits' => $this->units->count(),
            ]),
            $this->mergeWhen($this->needToInclude($request, 'noOfTowers'), [
                'noOfTowers' => $this->towers->count(),
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
