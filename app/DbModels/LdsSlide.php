<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class LdsSlide extends Model
{
    use CommonModelFeatures;

    const TYPE_STANDARD = 'standard';
    const TYPE_CUSTOM = 'custom';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'title', 'background_color', 'image_id', 'type'
    ];
}
