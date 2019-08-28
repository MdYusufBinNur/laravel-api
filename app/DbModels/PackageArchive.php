<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class PackageArchive extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'packageId', 'signoutUserId', 'signoutComments', 'signature', 'signoutAt',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'signature' => 'boolean',
        'signoutAt' => 'datetime:Y-m-d h:i',
    ];
}
