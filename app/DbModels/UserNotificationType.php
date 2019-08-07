<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserNotificationType extends Model
{
    protected $fillable = [
        'createdByUserId', 'type', 'description'
    ];
}
