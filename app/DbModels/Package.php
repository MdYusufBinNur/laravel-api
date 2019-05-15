<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'unit_id', 'resident_id', 'type_id', 'entered_user_id', 'tracking_number', 'comments', 'notified_by_email', 'notified_by_text', 'notified_by_voice'
    ];
}
