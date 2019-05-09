<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ServiceRequestLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'comments', 'feedback', 'type', 'status', 'createdByUserId'
    ];
}
