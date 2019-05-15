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
        'createdByUserId', 'package_id', 'signout_user_id', 'signout_comments', 'signature', 'signout_at',
    ];
}
