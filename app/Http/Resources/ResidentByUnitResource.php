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
        $residentsByUnits = [];
        foreach ($this->resource as $resident) {
            $residentsByUnits[] = [
                'residentId' => $resident['id'] ?? null,
                'title' => $resident['title'],
                'unitId' => $resident['unitId'],
                'email' => $resident['email'] ?? '',
                'name' => $resident['name'] ?? '',
                $this->mergeWhen(isset($resident['userId']), [
                    'contactEmail' => $resident['contactEmail'] ?? null,
                    'type' => 'active',
                    'profilePic' => $resident['profilePic']
                ]),
                $this->mergeWhen(isset($resident['residentAccessRequestId']), [
                    'residentAccessRequestId' => $resident['residentAccessRequestId'] ?? null,
                    'type' => 'pending'
                ]),
            ];
        }
        return $residentsByUnits;
    }
}
