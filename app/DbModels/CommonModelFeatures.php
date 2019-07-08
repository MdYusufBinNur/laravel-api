<?php

namespace App\DbModels;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\SoftDeletes;

trait CommonModelFeatures
{
    //todo experiment model caching
    use SoftDeletes, Cachable;

    /**
     * Get the user who created
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'createdByUserId');
    }
}
