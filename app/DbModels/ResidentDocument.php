<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'createdByUserId', 'residentId', 'type', 'type', 'title'
    ];

    /**
     * get the resident
     *
     * @return HasOne
     */
    public function resident()
    {
        return $this->hasOne(Resident::class, 'id', 'residentId');
    }

    /**
     * get the attachments
     *
     * @return HasMany
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'resourceId')->where('type', Attachment::ATTACHMENT_TYPE_RESIDENT_DOCUMENT);
    }

}
