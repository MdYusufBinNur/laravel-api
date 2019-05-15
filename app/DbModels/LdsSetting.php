<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class LdsSetting extends Model
{
    use CommonModelFeatures;

    const ICON_SIZE_SMALL = 'small';
    const ICON_SIZE_LARGE = 'large';

    const ICON_COLOR_WHITE = 'white';
    const ICON_COLOR_COLOR = 'color';

    const THEME_CLASSIC = 'classic';
    const THEME_TRADITIONAL = 'traditional';
    const THEME_BLACK_TIE = 'black-tie';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'refresh_rate', 'show_packages', 'icon_size', 'icon_color', 'theme'
    ];
}
