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
        'createdByUserId', 'propertyId', 'themeId', 'selectedBackground', 'selectedHeadline', 'customImageAttachmentId', 'tileUploadedImage',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tileUploadedImage' => 'boolean',
    ];
}
