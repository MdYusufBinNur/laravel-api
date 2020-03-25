<?php

namespace App\Http\Resources;

class ResidentResource extends Resource
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
            'createdByUserId' => $this->createdByUserId,
            'propertyId' => $this->propertyId,
            'property' => $this->when($this->needToInclude($request, 'resident.property'), function () {
                return new PropertyResource($this->property);
            }),
            'userId' => $this->userId,
            'unitId' => $this->unitId,
            'unit' => $this->when($this->needToInclude($request, 'resident.unit'), function () {
                return new UnitResource($this->unit);
            }),
            'contactEmail' => $this->contactEmail,
            'isOwnerLivingHere' => $this->isOwnerLivingHere,
            'type' => $this->type,
            'group' => $this->group,
            'boardMember' => $this->boardMember,
            'sendEmailPermission' => $this->sendEmailPermission,
            'displayUnit' => $this->displayUnit,
            'displayPublicProfile' => $this->displayPublicProfile,
            'allowPostNote' => $this->allowPostNote,
            'allowSendMessage' => $this->allowSendMessage,
            'defaultDial' => $this->defaultDial,
            'homePhone' => $this->homePhone,
            'cellPhone' => $this->cellPhone,
            'employerName' => $this->employerName,
            'employerAddress' => $this->employerAddress,
            'businessPhone' => $this->businessPhone,
            'businessEmail' => $this->businessEmail,
            'secondaryAddress' => $this->secondaryAddress,
            'secondaryPhone' => $this->secondaryPhone,
            'secondaryEmail' => $this->secondaryEmail,
            'joiningDate' => $this->joiningDate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => $this->when($this->needToInclude($request, 'resident.user'), function () {
                return new UserResource($this->user);
            }),
            'residentEmergency' => $this->when($this->needToInclude($request, 'resident.residentEmergency'), function () {
                return new ResidentEmergencyResource($this->residentEmergency);
            }),
            'label' => $this->residentLabel
        ];
    }
}
