<?php

namespace App\Http\Requests\Post;

use App\DbModels\Post;
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
            'propertyId' => 'required|exists:properties,id',
            'type' => 'required|in:' . Post::TYPE_EVENT . ',' . Post::TYPE_MARKETPLACE . ',' . Post::TYPE_POLL . ',' . Post::TYPE_RECOMMENDATION . ',' . Post::TYPE_WALL,
            'attachmentIds' => 'json|json_ids:attachments,id'
        ];
    }
}
