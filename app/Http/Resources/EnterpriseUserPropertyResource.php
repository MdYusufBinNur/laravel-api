<?php

namespace App\Http\Resources;

class EnterpriseUserPropertyResource extends Resource
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
            'id' => $this->getIdOrUuid(),
            'enterpriseUserId' => $this->enterpriseUserId,
            'enterpriseUser' => $this->when($this->needToInclude($request, 'eup.enterpriseUser'), function () {
                return new EnterpriseUserResource($this->enterPriseUser);
            }),
            'propertyId' => $this->propertyId,
            'property' => $this->when($this->needToInclude($request, 'eup.property'), function () {
                return new PropertyResource($this->property);
            }),
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
