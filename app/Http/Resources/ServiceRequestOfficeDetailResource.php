<?php

namespace App\Http\Resources;

class ServiceRequestOfficeDetailResource extends Resource
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
            'serviceRequestId' => $this->serviceRequestId,
            'assignedUserId' => $this->assignedUserId,
            'materialUsed' => $this->materialUsed,
            'materialAmount' => $this->materialAmount,
            'handyman' => $this->handyman,
            'outsideContractor' => $this->outsideContractor,
            'partsNeeded' => $this->partsNeeded,
            'comment' => $this->comment,
            'temporarilyRepaired' => $this->temporarilyRepaired,
            'signature' => $this->signature,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
