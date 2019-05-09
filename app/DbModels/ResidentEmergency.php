<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ResidentEmergency extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'resident_id', 'name', 'relationship', 'address', 'home_phone', 'cell_phone', 'email'
    ];
}
