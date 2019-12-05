<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tower extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'propertyId', 'title', 'createdByUserId'
    ];

    /**
     * Get the units for the tower.
     *
     * @return HasMany
     */
    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    /**
     * Get the property of the tower
     *
     * @return BelongsTo
     */
    public function property()
    {
        return $this->belongsTo(Company::class);
    }
}
