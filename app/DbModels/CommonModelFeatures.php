<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\SoftDeletes;

trait CommonModelFeatures
{
    use SoftDeletes;

    /**
     * Get the user who created
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }




}
