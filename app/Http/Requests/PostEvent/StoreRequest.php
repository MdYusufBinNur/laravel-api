<?php

namespace App\Http\Requests\PostEvent;

use App\Http\Requests\Request;

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
            'eventId' =>  'required|exists:events,id',

            'post' => '',
            'post.propertyId' => 'required_with:post|exists:properties,id',
            'post.attachmentIds' => 'json|json_ids:attachments,id',
        ];
    }
}
