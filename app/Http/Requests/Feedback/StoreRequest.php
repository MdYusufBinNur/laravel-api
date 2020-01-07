<?php

namespace App\Http\Requests\Feedback;

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
            'propertyId' => 'exists:properties,id',
            'category' => 'required|max:255',
            'feedbackText' => 'required|max:65535',
            'status' => 'boolean',
            'attachmentIds' => [new ListOfIds('attachments', 'id')],
        ];
    }
}
