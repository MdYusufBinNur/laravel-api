<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ServiceRequestStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'createdByUserId'
    ];
}
