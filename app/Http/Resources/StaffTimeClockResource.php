<?php

namespace App\Http\Resources;

class StaffTimeClockResource extends Resource
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
            'createdByUser' => $this->when($this->needToInclude($request, 'stc.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'managerId' => $this->managerId,
            'manager' => $this->when($this->needToInclude($request, 'stc.manager'), function () {
                return new StaffResource($this->manager);
            }),
            'propertyId' => $this->propertyId,
            'property' => $this->when($this->needToInclude($request, 'stc.property'), function () {
                return new PropertyResource($this->property);
            }),
            'state' => $this->state,
            'clockedIn' => $this->clockedIn,
            'clockedOut' => $this->clockedOut,
            'clockInNote' => $this->clockInNote,
            'clockOutNote' => $this->clockOutNote,
            'clockInPhoto' => $this->when($this->needToInclude($request, 'stc.clockInPhoto'), function () {
                return new AttachmentResource($this->clockInPhoto);
            }),
            'clockOutPhoto' => $this->when($this->needToInclude($request, 'stc.clockOutPhoto'), function () {
                return new AttachmentResource($this->clockOutPhoto);
            }),
            'timeClockInDeviceId' => $this->timeClockInDeviceId,
            'timeClockInDevice' => $this->when($this->needToInclude($request, 'stc.timeClockInDevice'), function () {
                return new TimeClockDeviceResource($this->timeClockInDevice);
            }),
            'timeClockOutDeviceId' => $this->timeClockOutDeviceId,
            'timeClockOutDevice' => $this->when($this->needToInclude($request, 'stc.timeClockOutDevice'), function () {
                return new TimeClockDeviceResource($this->timeClockOutDevice);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
