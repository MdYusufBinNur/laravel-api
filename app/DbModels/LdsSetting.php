<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'createdByUserId', 'propertyId', 'refreshRate', 'showPackages', 'iconSize', 'iconColor', 'theme'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'showPackages' => 'boolean',
    ];

    protected $attributes = [
        'refreshRate' => 30,
        'iconSize' => self::ICON_SIZE_SMALL,
        'iconColor' => self::ICON_COLOR_COLOR,
        'theme' => self::THEME_CLASSIC
    ];


    /**
     * get the property
     *
     * @return HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }
}
