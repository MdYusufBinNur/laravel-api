<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class PropertyDesignSetting extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'themeId', 'selectedBackground', 'selectedHeadline', 'customImage', 'tileUploadedImage',
    ];
}
