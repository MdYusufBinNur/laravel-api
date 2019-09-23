<?php

namespace App\Http\Requests\LdsSetting;

use App\DbModels\LdsSetting;
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
            'refreshRate' => 'integer',
            'showPackages' => 'boolean',
            'iconSize' => 'in:' . LdsSetting::ICON_SIZE_LARGE . ',' . LdsSetting::ICON_SIZE_SMALL,
            'iconColor' => 'in:' . LdsSetting::ICON_COLOR_COLOR . ',' . LdsSetting::ICON_COLOR_WHITE,
            'theme' => 'in:' . LdsSetting::THEME_BLACK_TIE . ',' . LdsSetting::THEME_CLASSIC . ',' . LdsSetting::THEME_TRADITIONAL,
        ];
    }
}
