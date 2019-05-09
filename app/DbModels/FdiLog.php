<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class FdiLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'fdi_id', 'user_id', 'text', 'type'
    ];
}

