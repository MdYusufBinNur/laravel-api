<?php

namespace App\Http\Requests\NotificationFeed;

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
            'userId' => 'list:numeric',
            'name' => 'list:string',
            'content' => 'list:string',
            'isRead' => 'list:boolean',
            'isViewed' => 'list:boolean',
        ];
    }
}
