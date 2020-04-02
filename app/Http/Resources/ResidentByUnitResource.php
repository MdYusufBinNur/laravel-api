<?php

namespace App\Http\Resources;

class ResidentByUnitResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        request()->merge(['include' => 'image.avatar']);
        $residentsByUnits = [];
        foreach ($this->resource as $unitResident) {

            $residentsByUnits[] = [
                'residentId' => $unitResident['id'] ?? null,
                'title' => $unitResident['title'],
                'unitId' => $unitResident['unitId'],
                'name' => $unitResident['name'] ?? '',
                'email' => $unitResident['email'] ?? '',
                'phone' => $unitResident['phone'] ?? '',
                $this->mergeWhen(isset($unitResident['userId']), [
                    'contactEmail' => $unitResident['contactEmail'] ?? null,
                    'type' => 'active'
                ]),
                'profilePic' => new AttachmentResource($unitResident['profilePic']),
                $this->mergeWhen(isset($unitResident['residentAccessRequestId']), [
                    'residentAccessRequestId' => $unitResident['residentAccessRequestId'] ?? null,
                    'type' => 'pending'
                ]),
            ];
        }
        return $residentsByUnits;
    }
}
