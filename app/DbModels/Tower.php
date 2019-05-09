<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'property_id', 'title', 'createdByUserId'
    ];

    /**
     * Get the units for the tower.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    /**
     * Get the property of the tower
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property()
    {
        return $this->belongsTo(Company::class);
    }
}
