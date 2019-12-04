<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
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
        'createdByUserId', 'title', 'backgroundColor', 'imageId', 'type'
    ];

    /**
     * get slide Image
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne(Attachment::class, 'id','imageId');
    }
}
