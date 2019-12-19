<?php

namespace App\Http\Requests\Feedback;

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
            'category' => 'max:255',
            'feedbackText' => 'max:65535',
            'status' => 'boolean',
        ];
    }
}
