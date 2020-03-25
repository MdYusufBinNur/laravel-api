<?php

namespace App\Http\Resources;

class EnterpriseUserResource extends Resource
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
            'id' => $this->id,
            'userId' => $this->userId,
            'user' => $this->when($this->needToInclude($request, 'eu.user'), function () {
                return new UserResource($this->user);
            }),
            'companyId' => $this->companyId,
            'company' => $this->when($this->needToInclude($request, 'eu.company'), function () {
                return new CompanyResource($this->company);
            }),
            'contactEmail' => $this->contactEmail,
            'phone' => $this->phone,
            'title' => $this->title,
            'level' => $this->level,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'properties' => $this->when($this->needToInclude($request, 'eu.properties'), function () {
                return new PropertyResourceCollection($this->getAssignedProperties());
            }),
            'label' => $this->enterPriseUserLabel,
        ];
    }
}
