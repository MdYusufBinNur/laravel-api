<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class LdsSetting extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'refresh_rate', 'show_packages', 'icon_size', 'icon_color', 'theme'
    ];
}
