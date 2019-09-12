<?php

namespace App\Http\Resources;

class PropertyResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
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
            'unregisteredResidentNotifications' => $this->unregisteredResidentNotifications,
            'active' => $this->active,

            'noOfUsers' => $this->when($this->needToInclude($request, 'noOfUsers'), function () {
                return $this->users->count();
            }),
            'noOfUnits' => $this->when($this->needToInclude($request, 'noOfUnits'), function () {
                return $this->units->count();
            }),
            'noOfTowers' => $this->when($this->needToInclude($request, 'noOfTowers'), function () {
                return $this->towers->count();
            }),
            'images' => $this->when($this->needToInclude($request, 'images'), function () {
                return new PropertyImageResourceCollection($this->propertyImages);
            }),
            'designSettings' => $this->when($this->needToInclude($request, 'designSettings'), function () {
                return new PropertyDesignSettingResource($this->propertyDesignSetting);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
