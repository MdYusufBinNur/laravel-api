<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Fdi extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'user_id', 'unit_id', 'guest_type_id', 'type', 'name', 'photo', 'start_date', 'end_date', 'permanent', 'comments', 'can_get_key', 'signature', 'status'
    ];
}
