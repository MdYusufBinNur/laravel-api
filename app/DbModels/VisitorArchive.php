<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class VisitorArchive extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'visitorId', 'signoutUserId', 'signature', 'signoutAt'
    ];
}
