<?php

namespace App\Http\Resources;


use App\DbModels\User;

class ParkingSpaceResource extends Resource
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
            'propertyId' => $this->propertyId,
            'parkingNumber' => $this->parkingNumber,
            'ownerUserId' => $this->ownerUserId,
            'ownerUser' =>$this->when($this->needToInclude($request, 'ps.ownerUser'), function () {
                return  new UserResource($this->ownerUser);
            }),
            'currentlyAssignedPass' =>$this->when($this->needToInclude($request, 'ps.currentlyAssignedPass'), function () {
                return  new ParkingPassResource($this->currentlyAssignedPass);
            }),
            'ownedBy' => $this->ownedBy ?? $this->ownerUser->name,
            'address' => $this->address ,
            'email' => $this->email ?? $this->ownerUser instanceof User ? $this->ownerUser->email : null,
            'phone' => $this->phone ?? $this->ownerUser instanceof User ? $this->ownerUser->phone : null,
        ];
    }
}
