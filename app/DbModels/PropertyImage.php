<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'title', 'imageId'
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
