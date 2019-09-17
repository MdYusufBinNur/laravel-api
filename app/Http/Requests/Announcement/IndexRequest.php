<?php

namespace App\Http\Requests\Announcement;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'propertyId' => 'list:numeric',
            'title' => 'list:string',
            'content' => 'list:string',
            'link' => 'list:string',
            'linkinNewWindows' => 'list:boolean',
            'showOnWebsite' => 'list:boolean',
            'showOnLds' => 'list:boolean',
            'expireAt' => 'date',
            'isExpired' => 'boolean',
            'query' => 'string',
        ];
    }
}
