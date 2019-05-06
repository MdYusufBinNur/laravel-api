<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tower_id', 'title', 'floor', 'line',
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
