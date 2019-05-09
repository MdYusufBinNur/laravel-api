<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class NotificationTemplateProperty extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'template_id'
    ];
}
