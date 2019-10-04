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
                . ',' . Attachment::ATTACHMENT_TYPE_PROPERTY_BANNER
                . ',' . Attachment::ATTACHMENT_TYPE_PROPERTY_GALLERY
                . ',' . Attachment::ATTACHMENT_TYPE_USER_PROFILE
                . ',' . Attachment::ATTACHMENT_TYPE_PROPERTY_DESIGN_CUSTOM
                . ',' . Attachment::ATTACHMENT_TYPE_PROPERTY_SLIDE
                . ',' . Attachment::ATTACHMENT_TYPE_SERVICE_REQUEST
                . ',' . Attachment::ATTACHMENT_TYPE_POST
                . ',' . Attachment::ATTACHMENT_TYPE_FDI
                . ',' . Attachment::ATTACHMENT_TYPE_VISITOR
                . ',' . Attachment::ATTACHMENT_TYPE_MESSAGE,
            'fileSource'   => 'required|file|max:2048',
            'resourceId'   => 'required',
            'fileName'     => '',
            'descriptions' => '',
            'fileType'     => '',
            'fileSize'     => ''
        ];
    }
}
