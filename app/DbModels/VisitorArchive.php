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
        'createdByUserId', 'visitor_id', 'signout_user_id', 'signature', 'signout_at'
    ];
}
