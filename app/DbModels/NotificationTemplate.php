<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class NotificationTemplate extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'type_id', 'title', 'text', 'editable'
    ];
}
