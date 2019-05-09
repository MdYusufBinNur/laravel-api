<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class LdsSlide extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'title', 'background_color', 'image_id', 'type'
    ];
}
