<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyImage extends Model
{
    use CommonModelFeatures;

    const TYPE_LOGO = 'property-logo';
    const TYPE_BANNER = 'property-banner';
    const TYPE_GALLERY = 'property-gallery';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'title', 'imageId', 'type'
    ];

    /**
     * Get the custom image
     *
     * @return BelongsTo
     */
    public function image()
    {
        return $this->belongsTo(Attachment::class, 'imageId');
    }
}
