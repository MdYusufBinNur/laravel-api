<?php

namespace App\Http\Resources;

class EnterpriseUserResource extends Resource
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
            'userId' => $this->userId,
            'companyId' => $this->companyId,
            'contactEmail' => $this->contactEmail,
            'phone' => $this->phone,
            'title' => $this->title,
            'level' => $this->level,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
