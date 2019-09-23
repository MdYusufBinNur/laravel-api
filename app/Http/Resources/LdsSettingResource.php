<?php

namespace App\Http\Resources;


class LdsSettingResource extends Resource
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
            'property' => $this->when($this->needToInclude($request, 'ldss.property'), function () {
                return new PropertyResource($this->property);
            }),
            'refreshRate' => $this->refreshRate,
            'showPackages' => $this->showPackages,
            'iconSize' => $this->iconSize,
            'iconColor' => $this->iconColor,
            'theme' => $this->theme,
        ];
    }
}
