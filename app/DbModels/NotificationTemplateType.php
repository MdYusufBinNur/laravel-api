<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class NotificationTemplateType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'key', 'module'
    ];
}
