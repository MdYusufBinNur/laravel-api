<?php

namespace App\Http\Requests\ServiceRequest;

use App\DbModels\ServiceRequest;
use App\Http\Requests\Request;
use App\Rules\ListOfIds;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'propertyId' => 'required|exists:properties,id',
            'userId' => 'required|exists:users,id',
            'unitId' => 'required|exists:units,id',
            'categoryId' => 'required|exists:service_request_categories,id',
            'phone' => 'max:20',
            'description' => 'required|max:1024',
            'permissionToEnter' => 'boolean',
            'preferredStartTime' => 'date',
            'preferredEndTime' => 'date',
            'photo' => 'boolean',
            'attachmentIds' => [new ListOfIds('attachments', 'id')]
        ];
    }
}
