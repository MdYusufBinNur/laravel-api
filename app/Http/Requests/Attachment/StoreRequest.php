<?php

namespace App\Http\Requests\Attachment;

use App\DbModels\Attachment;
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
        return $rules = [
            'type'         => 'required|in:' . Attachment::ATTACHMENT_TYPE_GENERIC
                . ',' . Attachment::ATTACHMENT_TYPE_PROPERTY_LOGO
                . ',' . Attachment::ATTACHMENT_TYPE_USER_PROFILE_PIC,
            'fileSource'   => 'required|file|max:2048',
            'resourceId'   => 'required',
            'fileName'     => '',
            'descriptions' => '',
            'fileType'     => '',
            'fileSize'     => ''
        ];
    }
}