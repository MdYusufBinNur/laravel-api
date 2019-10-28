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
<<<<<<< HEAD
            'phone' => 'min:11|max:20',
            'description' => 'required|min:10|max:65535',
=======
            'phone' => 'max:20',
            'description' => 'required|max:1024',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'permissionToEnter' => 'boolean',
            'preferredStartTime' => 'date',
            'preferredEndTime' => 'date',
            'photo' => 'boolean',
            'attachmentIds' => [new ListOfIds('attachments', 'id')]
        ];
    }
}
