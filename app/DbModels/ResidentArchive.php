<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ResidentArchive extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'resident_id', 'unit_id', 'start_at', 'end_at'
    ];
}
