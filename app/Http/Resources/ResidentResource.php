<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResidentResource extends JsonResource
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
            'id'                    => $this->id,
            'createdByUserId'       => $this->createdByUserId,
            'propertyId'            => $this->propertyId,
            'userId'                => $this->userId,
            'unitId'                => $this->unitId,
            'contactEmail'          => $this->contactEmail,
            'type'                  => $this->type,
            'group'                 => $this->group,
            'boardMember'           => $this->boardMember,
            'sendEmailPermission'   => $this->sendEmailPermission,
            'displayUnit'           => $this->displayUnit,
            'displayPublicProfile'  => $this->displayPublicProfile,
            'allowPostNote'         => $this->allowPostNote,
            'allowSendMessage'      => $this->allowSendMessage,
            'defaultDial'           => $this->defaultDial,
            'homePhone'             => $this->homePhone,
            'cellPhone'             => $this->cellPhone,
            'employerName'          => $this->employerName,
            'employerAddress'       => $this->employerAddress,
            'businessPhone'         => $this->businessPhone,
            'businessEmail'         => $this->businessEmail,
            'secondaryAddress'      => $this->secondaryAddress,
            'secondaryPhone'        => $this->secondaryPhone,
            'secondaryEmail'        => $this->secondaryEmail,
            'joiningDate'           => $this->joiningDate,
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at
        ];
    }
}