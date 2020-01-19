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
            'companyId' => $this->companyId,
            'company' => $this->when($this->needToInclude($request, 'property.company'), function () {
                return new CompanyResource($this->company);
            }),
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
            'noOfUsers' => $this->when($this->needToInclude($request, 'property.noOfUsers'), function () {
                return $this->users->count();
            }),
            'noOfUnits' => $this->when($this->needToInclude($request, 'property.noOfUnits'), function () {
                return $this->units->count();
            }),
            'noOfTowers' => $this->when($this->needToInclude($request, 'property.noOfTowers'), function () {
                return $this->towers->count();
            }),
            'images' => $this->when($this->needToInclude($request, 'property.images'), function () {
                return new PropertyImageResourceCollection($this->propertyImages);
            }),
            'designSettings' => $this->when($this->needToInclude($request, 'property.designSettings'), function () {
                return new PropertyDesignSettingResource($this->propertyDesignSetting);
            }),
            'propertyModules' => $this->when($this->needToInclude($request, 'property.propertyModules'), function () {
                return new ModulePropertyResourceCollection($this->moduleProperties);
            }),
            'loginLink' => $this->getLoginLink(),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
