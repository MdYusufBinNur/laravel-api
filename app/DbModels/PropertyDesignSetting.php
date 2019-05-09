<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class PropertyDesignSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'theme_id', 'selected_background', 'selected_headline', 'custom_image', 'tile_uploaded_image',
    ];
}
