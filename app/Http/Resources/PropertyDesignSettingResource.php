<?php

namespace App\Http\Resources;

class PropertyDesignSettingResource extends Resource
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
            'themeId' => $this->themeId,
            'selectedBackground' => $this->selectedBackground,
            'selectedHeadline' => $this->selectedHeadline,
            'customImageAttachmentId' => $this->customImageAttachmentId,
            'tileUploadedImage' => $this->tileUploadedImage,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
