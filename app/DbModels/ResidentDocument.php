<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ResidentDocument extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'residentId', 'type', 'attachmentId', 'type', 'tittle'
    ];

    /**
     * get the unit
     *
     * @return HasOne
     */
    public function resident()
    {
        return $this->hasOne(Resident::class, 'id', 'residentId');
    }

}
