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
            'propertyId' => $this->propertyId,
            'property' => $this->when($this->needToInclude($request, 'pa.property'), function () {
                return new PropertyResource($this->property);
            }),
            'packageId' => $this->packageId,
            'package' => $this->when($this->needToInclude($request, 'pa.package'), function () {
                return new PackageResource($this->package);
            }),
            'signOutUserId' => $this->signOutUserId,
            'signOutUser' => $this->when($this->needToInclude($request, 'pa.signOutUser'), function () {
                return new UserResource($this->signOutUser);
            }),
            'signOutComment' => $this->signOutComment,
            'signature' => $this->signature,
            'signOutAt' => $this->signOutAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
