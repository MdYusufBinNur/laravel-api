<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
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

    /**
     * Get the custom image
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customImage()
    {
        return $this->belongsTo(Attachment::class, 'customImageAttachmentId');
    }
}
