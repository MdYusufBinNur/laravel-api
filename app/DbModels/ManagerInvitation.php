<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ManagerInvitation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'first_name', 'last_name', 'email', 'title', 'level', 'status', 'pin', 'invited_at'
    ];
}
