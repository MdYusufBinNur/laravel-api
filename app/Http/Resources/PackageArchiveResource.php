<?php

namespace App\Http\Resources;

class PackageArchiveResource extends Resource
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
            'packageId' => $this->packageId,
            'signoutUserId' => $this->signoutUserId,
            'signoutComments' => $this->signoutComments,
            'signature' => $this->signature,
            'signoutAt' => $this->signoutAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
