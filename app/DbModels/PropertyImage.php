<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use CommonModelFeatures;

    const TYPE_LOGO = 'logo';
    const TYPE_BANNER = 'banner';
    const TYPE_GALLERY = 'gallery';
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo(Attachment::class, 'imageId');
    }
}
