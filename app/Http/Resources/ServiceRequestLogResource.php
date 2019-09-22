<?php

namespace App\Http\Resources;

use App\DbModels\ServiceRequestLog;
use Illuminate\Support\Str;

class ServiceRequestLogResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $response  = [
            'id' => $this->id,
            'createdByUserId' => $this->createdByUserId,
            'serviceRequestId' => $this->serviceRequestId,
            'serviceRequest' => $this->when($this->needToInclude($request, 'srLog.serviceRequest'), function () {
                return new ServiceRequestResource($this->serviceRequest);
            }),
            'userId' => $this->userId,
            'user' => $this->when($this->needToInclude($request, 'srLog.user'), function () {
                return new UserResource($this->user);
            }),
            'type' => $this->type,
            'feedback' => $this->feedback,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
        $additionalMessage = $this->buildMessage();

        return array_merge($response, $additionalMessage);
    }

    private function buildMessage()
    {
        $message = [];

        switch ($this->type) {
            case ServiceRequestLog::TYPE_CREATED:
                $message['readable'] = 'Service Request created by ' . $this->user->name;
                break;
            case ServiceRequestLog::TYPE_STATUS:
                $message['readable'] = 'Status changed to ' . str_replace('_', ' ', $this->status);
                break;
            case ServiceRequestLog::TYPE_COMMENT:
                $message['readable'] = 'Comment by ' . $this->user->name;
                $message['messageDetails'] = new ServiceRequestMessageResource($this->message);
                break;
            case ServiceRequestLog::TYPE_FEEDBACK:
                $message['readable'] = Str::title($this->feedback) . ' feedback given by ' . $this->user->name;
                $message['messageDetails'] = new ServiceRequestMessageResource($this->message);
                break;
            case ServiceRequestLog::TYPE_ASSIGNMENT:
                $message['readable'] = 'Assigned to ' . $this->user->name;
                break;
        }

        return $message;
    }
}
