<?php

namespace App\Http\Requests\PropertyDesignSetting;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'themeId' => 'integer',
            'selectedBackground' => 'max:6',
            'selectedHeadline' => 'max:6',
            'customImageAttachmentId' => 'exists:attachments,id',
            'tileUploadedImage' => 'boolean',
        ];
    }
}
