<?php

namespace App\Http\Requests\Attachment;

use App\DbModels\Attachment;
use App\Http\Requests\Request;
use App\Rules\CSVString;

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
                . ',' . Attachment::ATTACHMENT_TYPE_MESSAGE
                . ',' . Attachment::ATTACHMENT_TYPE_MESSAGE_POST
                . ',' . Attachment::ATTACHMENT_TYPE_EVENT
                . ',' . Attachment::ATTACHMENT_TYPE_LDS_SLIDE
                . ',' . Attachment::ATTACHMENT_TYPE_EQUIPMENT,
            'fileSource'   => 'required|file|max:15360',
            'resourceId'   => '',
            'fileName'     => '',
            'descriptions' => '',
            'fileType'     => '',
            'fileSize'     => '',

            'resizeImage'  => 'boolean',
            'width'  => 'required_with:resizeImage',
            'height'  => 'required_with:resizeImage',

            'multipleTypes'  => [new CSVString(['thumbnail', 'medium', 'large', 'avatar'])],
        ];
    }

    public function messages()
    {
        return [
            'upload.max' => "Maximum file size to upload is 15MB. If you are uploading a photo, try to reduce its resolution to make it under 15 MB"
        ];
    }
}
