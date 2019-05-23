<?php

namespace App\Http\Requests\Announcement;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'propertyId' => 'required|exists:properties,id',
            'title' => 'required|min:5|max:191',
            'content' => 'required|min:5|max:256',
            'link' => 'required|min:5|max:190',
            'linkinNewWindows' => 'boolean',
            'showOnWebsite' => 'boolean',
            'showOnLds' => 'boolean',
            'expireAt' => 'required|date',
        ];
    }
}
