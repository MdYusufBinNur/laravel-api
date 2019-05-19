<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'towerId', 'title', 'floor', 'line', 'createdByUserId'
    ];

    /**
     * Get the tower of the unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\Belongs
     */
    public function tower()
    {
        return $this->belongsTo(Tower::class);
    }
}
