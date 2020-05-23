<?php

namespace App\Http\Resources;

class CompanyResource extends Resource
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
            'id' => $this->getIdOrUuid(),
            'title' => $this->title,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'postCode' => $this->postCode,
            'active' => $this->active,
            'noOfProperties' => $this->when($this->needToInclude($request, 'company.noOfProperties'), function () {
               return $this->properties()->count();
            }),
            'noOfEnterpriseUsers' => $this->when($this->needToInclude($request, 'company.noOfEnterpriseUsers'), function () {
                return $this->enterpriseUsers()->count();
            }),
            'createdByUser' => $this->createdByUserId,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
