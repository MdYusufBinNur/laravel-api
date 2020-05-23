<?php

namespace App\Http\Resources;


class CustomerResource extends Resource
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
            'createdByUserId' => $this->createdByUserId,
            'propertyId' => $this->propertyId,
            'name' => $this->name,
            'email' =>$this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'website' => $this->website,
            'billingInfo' => $this->billingInfo,
            'additionalNote' => $this->additionalNote,
        ];
    }
}
