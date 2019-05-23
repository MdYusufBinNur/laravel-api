<?php

namespace App\Http\Requests\Announcement;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'propertyId' => 'exists:properties,id',
            'title' => 'min:5|max:191',
            'content' => 'min:5|max:256',
            'link' => 'min:5|max:190',
            'linkinNewWindows' => 'numeric',
            'showOnWebsite' => 'numeric',
            'showOnLds' => 'numeric',
            'expireAt' => 'date',
        ];
    }
}
